<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use mysqli;

class RunSqlQuery extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sql:run {query}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Execute a one-time SQL query on the database';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $server = 'loca';
        $username = env('DB_ROOTUSER', 'lla');
        $database = env('DB_DATABASE', 'lladb');
        $password = env('DB_PASSWORD', '14w0rdlla');

        // Establish connection to MySQL server
        $mysqli = new mysqli($server, $username, $password, $database);

        // Check connection
        if ($mysqli->connect_error) {
            die("Connection failed: " . $mysqli->connect_error);
        }

        $query = $this->argument('query');
        $result = $mysqli->query($query);
        if ($result->num_rows > 0) {
            $data = $result->fetch_assoc();
            $this->table(array_keys($data), [$data]);
            
            $this->info('Query executed successfully.');
        } else {
            $this->info('No rows found in the result.');
        }
        return 0;
    }
}
