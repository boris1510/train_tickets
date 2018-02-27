<?php

class Baza
{
    // Instanca PDO objekta
    private $dbh;

    // MySQL podaci
    private $host = 'sql206.epizy.com';
    private $username = 'epiz_21673449';
    private $password = 'dancer1510';
    private $database = 'epiz_21673449_boris';

    /**
     * Konstruktor klase.
     * Stvara novi PDO objekt.
     */
    public function __construct()
    {
        try
        {
            // Stvori novi PDO objekt
            $this->dbh = new PDO('mysql:host=' . $this->host . ';dbname=' . $this->database . ';charset=utf8', $this->username, $this->password, [

                // PDO opcije
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC

            ]);
        }
        catch (PDOException $e)
        {
            http_response_code(500);
            die($e->getMessage());
        }
    }

    /**
     * Izvršava SQL izjavu i vraća retke u obliku niza.
     * Samo za SELECT upite.
     *
     * @param string $sql SQL izjava
     * @param array $arr Ulazni parametri
     * @return array Rezultat upita
     */
    public function query($sql, $arr = array())
    {
        try
        {
            // Pripremi SQL upit
            $stmt = $this->dbh->prepare($sql);

            // Izvrši SQL upit
            $stmt->execute($arr);

            // Vrati rezultat upita
            return $stmt->fetchAll();
        }
        catch (PDOException $e)
        {
            http_response_code(500);
            die($e->getMessage());
        }
    }

    /**
     * Izvršava SQL izjavu i vraća broj pogođenih redaka.
     * Za INSERT, UPDATE i DELETE upite.
     *
     * @param string $sql SQL izjava
     * @param array $arr Ulazni parametri
     * @return int Rezultat upita
     */
    public function exec($sql, $arr = array())
    {
        try
        {
            // Pripremi SQL upit
            $stmt = $this->dbh->prepare($sql);

            // Izvrši SQL upit
            $stmt->execute($arr);

            // Vrati rezultat upita
            return $stmt->rowCount();
        }
        catch (PDOException $e)
        {
            http_response_code(500);
            die($e->getMessage());
        }
    }
}