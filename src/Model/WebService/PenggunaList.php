<?php declare(strict_types=1);

namespace Aframawandani\Dapodik\SDK\Model\WebService;

use Aframawandani\Dapodik\SDK\Auth\WebService;
use Aframawandani\Dapodik\SDK\Model\WebServiceModel;

class PenggunaList extends WebServiceModel
{
    /**
     * @var \stdClass[]
     */
    private array $property;

    /**
     * @var \Aframawandani\Dapodik\SDK\Model\WebService\Pengguna[]|null
     */
    public ?array $list;

    public function __construct(WebService $auth)
    {
        parent::__construct($auth);

        $this->property = $this->getPenggunaDetails();
        $this->list = $this->listPengguna();
    }

    public function getPenggunaDetails(): array
    {
        $response = $this->request("GET", "getPengguna");
        $this->body = json_decode($response->getBody()->__toString());
        return $this->body->rows;
    }

    public function listPengguna(): array
    {
        $penggunaList = array_map(function ($pengguna) {
            return new Pengguna($pengguna);
        }, $this->property);

        return $penggunaList;
    }
}