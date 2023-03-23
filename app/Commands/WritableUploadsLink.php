<?php

namespace App\Commands;

use Exception;
use CodeIgniter\CLI\CLI;

class WritableUploadsLink extends BaseCommand
{
  protected $group       = 'Writable';
  protected $name        = 'uploads:link';
  protected $description = 'Writable.uploads_link';

  public function run(array $params = [])
  {
    $targetFolder = WRITEPATH . "uploads";
    $linkFolder =  FCPATH . "uploads";

    try {
      symlink($targetFolder, $linkFolder);
      CLI::write(lang('Writable.uploads_link_success'), 'green');
    } catch (Exception $e) {
      CLI::write(lang('Writable.uploads_link_failed').' '.$e->getMessage(),'red');
    }
  }
}
