<?php

namespace App\Console\Commands;

use App\Models\MenuItem;
use GuzzleHttp\Client;
use Illuminate\Console\Command;

class GetMenuItemData extends Command
{

    protected $apiUrl = 'https://dev.shepherd.appoly.io/fruit.json';
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'get:menu-items';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command use to get the menu items from api and save into Database.';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        try {
            $client = new Client();

            $response = $client->request('GET', $this->apiUrl);

            $statusCode = $response->getStatusCode();
            $content = $response->getBody();
            if ($statusCode === 200) {

                $data = json_decode($content->getContents());
                if ($data->menu_items) {
                    foreach ($data->menu_items as $item) {
                        $this->addItems($item);
                    }
                }
            } else {
                throw new \Exception('Not get valid Data form api', $statusCode);
            }
        } catch (\Exception $exception) {
            $this->error($exception->getMessage());
            return self::FAILURE;
        }
        return self::SUCCESS;
    }

    protected function addItems($item, $parentId = 0)
    {
        $parentId = MenuItem::addEditFromCmd($item->label, $parentId);
        if (!empty($item->children)) {
            foreach ($item->children as $childItem) {
                $this->addItems($childItem, $parentId);
            }
        }
    }
}
