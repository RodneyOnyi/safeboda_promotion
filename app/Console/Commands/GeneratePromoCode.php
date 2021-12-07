<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\PromoCode;

class GeneratePromoCode extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'promocode:generate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate promo codes for clients.';

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
        (new PromoCode)->generateCodes();

        $this->info('Successfully generated promo codes.');
    }
}
