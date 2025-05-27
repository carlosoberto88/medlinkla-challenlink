<?php
/**
 * SpaghettiCode
 *
 * Demonstrates clean OOP code vs. spaghetti code for formatting a user's full name.
 *
 * Usage: php src/SpaghettiCode.php
 */
class User
{
    private string $firstName;
    private string $lastName;

    public function __construct(string $firstName, string $lastName)
    {
        $this->firstName = $firstName;
        $this->lastName = $lastName;
    }

    public function getFullName(): string
    {
        return $this->firstName . ' ' . $this->lastName;
    }
}

class SpaghettiCode
{
    /**
     * Returns a user's full name using OOP.
     * @param string $firstName
     * @param string $lastName
     * @return string
     */
    public static function formatFullName(string $firstName, string $lastName): string
    {
        $user = new User($firstName, $lastName);
        return $user->getFullName();
    }
}

// Spaghetti code example (do not use):
// $first = 'John'; $last = 'Doe'; echo $first.' '.$last;

// Sample run
if (basename(__FILE__) == basename($_SERVER['SCRIPT_FILENAME'])) {
    echo SpaghettiCode::formatFullName('Jane', 'Smith')."\n";
} 