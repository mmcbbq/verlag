<?php

// Abstrakte Basisklasse für alle Repository-Klassen (z. B. zur Datenbankkommunikation)
abstract class AbstractRepository
{
    // Name der zugehörigen Tabelle (muss von der konkreten Kindklasse gesetzt werden)
    protected string $tablename;

    // Erstellt und gibt ein PDO-Datenbankobjekt zurück
    public function Dbcon(): PDO
    {
        return new PDO("mysql:host=localhost;dbname=verlag;charset=utf8mb4", 'root', '');
    }

    // Führt eine SQL-Abfrage aus und gibt das Ergebnis als Array zurück
    public function query($sql, $data = []): array|false
    {
        $dbcon = $this->Dbcon();                    // Verbindung zur Datenbank herstellen
        $stm = $dbcon->prepare($sql);               // SQL-Anweisung vorbereiten
        $result = $stm->execute($data);             // Ausführung der Abfrage mit Platzhalterdaten
        $return = $stm->fetchAll(PDO::FETCH_ASSOC); // Alle Zeilen als assoziatives Array holen
        $id = $dbcon->lastInsertId();               // Prüfen, ob ein neuer Datensatz eingefügt wurde

        if ($id) {
            // Wenn ja, Rückgabe der neuen ID
            $return = ['id' => (int)$id];
        }

        // Rückgabe des Ergebnisses oder false bei Fehler
        return $result ? $return : false;
    }

    /**
     * Gibt alle Datensätze als Array von Entity-Objekten zurück
     * @return EntityInterface[]
     */
    public function findall(): array
    {
        $sql = "SELECT * FROM $this->tablename";
        $return = [];

        // Wandelt jede Datenbankzeile in ein Entity-Objekt um
        foreach ($this->query($sql) as $item) {
            $return[] = new $this->tablename($item);
        }

        return $return;
    }

    /**
     * Findet einen Datensatz anhand der ID und gibt ein entsprechendes Entity-Objekt zurück
     * @param int $id
     * @return EntityInterface
     */
    public function findById(int $id): EntityInterface
    {
        $sql = "SELECT * FROM $this->tablename WHERE id = :id";
        $sqldata = [':id' => $id];

        // Holt das erste (und einzige) Ergebnis
        $data = $this->query($sql, $sqldata)[0];

        // Gibt ein neues Entity-Objekt mit den geladenen Daten zurück
        return new $this->tablename($data);
    }

    /**
     * Entfernt einen Datensatz basierend auf dem Entity-Objekt
     * @param object $obj
     * @return bool
     */
    public function remove(object $obj): bool
    {
        $sql = "DELETE FROM $this->tablename WHERE id = :id";
        $data = [':id' => $obj->getId()];

        // Führt Lösch-Abfrage aus und prüft ob Ergebnis leer ist (d.h. Erfolg)
        $result = $this->query($sql, $data);
        return ($result === []);
    }

    /**
     * Aktualisiert einen vorhandenen Datensatz basierend auf einem Entity-Objekt
     * @param EntityInterface $obj
     * @return EntityInterface
     */
    public function update(EntityInterface $obj): EntityInterface
    {
        $data = $obj->mapToArray();            // Wandelt Objekt in Array um
        $keys = array_keys($data);
        $string = '';                          // Teil für SET-Klausel im SQL-Statement

        // Erzeugt den String für das SQL-Update-Statement
        foreach ($keys as $index => $key) {
            if ($key === ':id') continue;      // ID wird im WHERE verwendet, nicht im SET
            $spalte = str_replace(':', '', $key);
            $string .= "$spalte = $key, ";
        }

        $string = rtrim($string, ', ');        // Entfernt das letzte Komma
        $sql = "UPDATE $this->tablename SET $string WHERE id = :id";

        $this->query($sql, $data);

        // Gibt das aktualisierte Objekt zurück
        return $this->findById($obj->getId());
    }

    /**
     * Erstellt einen neuen Datensatz basierend auf einem Entity-Objekt
     * @param EntityInterface $entity
     * @return EntityInterface
     */
    public function create(EntityInterface $entity): EntityInterface
    {
        $data = $entity->mapToArray();         // Objekt in Array umwandeln
        unset($data[':id']);                   // ID wird bei neuen Einträgen nicht mitgegeben

        $keys = array_keys($data);
        $spalte = '';                          // Liste der Spalten
        $placeholder = '';                     // Liste der Platzhalter (für prepared statement)

        // Erzeugt die Listen für Spalten und Platzhalter
        foreach ($keys as $key) {
            if ($key === ':id') continue;
            $spalte .= str_replace(':', '', $key) . ', ';
            $placeholder .= "$key, ";
        }

        $spalte = rtrim($spalte, ', ');
        $placeholder = rtrim($placeholder, ', ');

        $sql = "INSERT INTO $this->tablename ( $spalte ) VALUES ( $placeholder )";

        // Führt Einfüge-Abfrage aus und holt das neue Objekt per ID
        $result = $this->query($sql, $data);
        return $this->findById($result['id']);
    }
}
