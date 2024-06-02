<?php
try {
    global $dbc;
    $dbc = new PDO(
        'mysql:host=localhost;dbname=blogg;charset=utf8',
        'it',
        'abc123!'
    );
} catch (PDOException $exception) {
    echo '<p class="error">Misslyckades att ansluta till databas: ' . $exception->getMessage() . '</p>';
    die();
}

/**
 * Queries the database and returns the rows if the request was successful, or
 * null if the request failed. All values in `$values` are bound using `bindValue`
 * with the `:` prefix.
 */
function queryDB(string $query, ?array $values = null): ?array
{
    if ($values === null) {
        $values = array();
    }

    global $dbc;
    if (!isset($dbc)) {
        throw new IllegalStateException('There is no database connection');
    }
    $statement = $dbc->prepare($query);
    foreach ($values as $key => $value) {
        $statement->bindValue(":$key", $value);
    }
    $success = $statement->execute();
    if (!$success)
        return null;
    $rows = $statement->fetchAll(PDO::FETCH_ASSOC);
    return $rows;
}

class AuthorizationException extends Exception
{
    public function __construct($message = "", $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
;
class IllegalStateException extends Exception
{
    public function __construct($message = "", $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
;