#!/usr/bin/php

        <?php
        function combineCSV(array $inFile, $outFile)
        {
            if (!is_array($inFile)) {
                throw new Exception('`$inFile` must be an array');
            }

            $outFile = fopen($outFile, "w+");
            $headers = ['email_hash', 'category', 'filename'];
            fputcsv($outFile, $headers);

            foreach ($inFile as $file) {

                $handle = fopen($file, "r");
                fgets($handle);

                while (($line = fgetcsv($handle, 1000, ",")) !== FALSE) {

                    $line[] = $file;
                    fputcsv($outFile, $line);
                    $line = fgetcsv($handle);

                    fwrite($outFile, fgets($handle));
                }

                fclose($handle);
                unset($handle);
                fwrite($outFile, "\n");
            }

            fclose($outFile);
            unset($outFile);
        }

        ?>
  