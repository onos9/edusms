<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use mysqli;

class ReplicationCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'replica:start';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Initialize MariaDB replication servers';

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
        $username = 'root';
        $password = env('DB_PASSWORD', 'localhost');
        $servers = array('localdb', 'remotedb');
        $replUser = env('DB_REPLICATION_USER', 'replicator');
        $replPassword = env('DB_REPLICATION_PASSWORD', 'repl1234or');

        foreach ($servers as $server) {
            $this->info($server);
            // Establish connection to MySQL server
            $mysqli = new mysqli($server, $username, $password);

            // Check connection
            if ($mysqli->connect_error) {
                die("Connection failed: " . $mysqli->connect_error);
            }

            // Get master status information
            $master = $mysqli->query("SHOW MASTER STATUS;");
            $masterRow = $master->fetch_assoc();
            $masterLog = $masterRow['File'];
            $masterPosition = $masterRow['Position'];

            // Connect slave to master
            $host = array_pop($servers);
            $mysqli->query("STOP SLAVE;");
            $mysqli->query("RESET SLAVE;");
            $mysqli->query("CHANGE MASTER TO MASTER_HOST='$host', MASTER_USER='$replUser', MASTER_PASSWORD='$replPassword', MASTER_LOG_FILE='$masterLog', MASTER_LOG_POS=$masterPosition;");
            $mysqli->query("START SLAVE;");

            // Show slave status
            $slaveStatus = $mysqli->query("SHOW SLAVE STATUS;");
            if ($slaveStatus->num_rows > 0) {
                while ($row = $slaveStatus->fetch_assoc()) {
                    // Output each row of the result
                    $this->line(' ');
                    foreach ($row as $key => $value) {
                        printf("%-30s : %s\n", $key, $value);
                    }
                    $this->line(' ');
                    $this->line('---------------------------------');
                    
                }
            } else {
                $this->info('No rows found in the result.');
            }

            $slaveStatus->free();
            // Close connection
            $mysqli->close();
        }

        return 0;
    }
}
