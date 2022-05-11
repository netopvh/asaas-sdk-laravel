<?php

namespace CreativeMobile\Asaas\Console;

use CreativeMobile\Asaas\AsaasServiceProvider;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class InstallAsaasPackage extends Command
{
  protected $signature = 'asaas:install';

  protected $description = 'Realiza a publicação dos arquivos de configuração';

  public function handle()
  {
    if (File::exists(\config_path('asaas.php'))) {
      if ($this->confirm('O arquivo de configuração já existe, deseja sobrescrever?', false)) {
        $this->publish(true);
        $this->info('Arquivo de configuração sobrescrito');
      }

      return;
    }

    $this->publish();
    $this->info('Arquivo de configuração copiado para ./config/asaas.php');
  }

  private function publish($force = false): void
  {
    $params = [
      '--provider'  => AsaasServiceProvider::class,
      '--tag'       => 'config'
    ];

    if ($force) {
      $params['--force'] = '';
    }

    $this->call('vendor:publish', $params);
  }
}
