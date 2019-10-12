<?php
/**
 * GetAccountRequest.php
 * Copyright (c) 2019 thegrumpydictator@gmail.com
 *
 * This file is part of Firefly III CSV Importer.
 *
 * Firefly III CSV Importer is free software: you can redistribute it and/or
 * modify it under the terms of the GNU General Public License as published
 * by the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * Firefly III CSV Importer is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with Firefly III CSV Importer.If not, see
 * <http://www.gnu.org/licenses/>.
 */

namespace App\Services\FireflyIIIApi\Request;


use App\Exceptions\ApiException;
use App\Exceptions\ApiHttpException;
use App\Services\FireflyIIIApi\Response\GetAccountResponse;
use App\Services\FireflyIIIApi\Response\Response;
use GuzzleHttp\Exception\GuzzleException;

/**
 * Class GetAccountRequest
 */
class GetAccountRequest extends Request
{
    /** @var int */
    private $id;


    /**
     * GetAccountsRequest constructor.
     */
    public function __construct()
    {
        $url        = config('csv_importer.uri');
        $token      = config('csv_importer.access_token');
        $this->setBase($url);
        $this->setToken($token);
        $this->setUri('accounts');
    }

    /**
     * @return Response
     * @throws ApiHttpException
     */
    public function get(): Response
    {
        try {
            $data = $this->authenticatedGet();
        } catch (ApiException|GuzzleException $e) {
            throw new ApiHttpException($e->getMessage());
        }

        return new GetAccountResponse($data['data']);
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
        $this->setUri(sprintf('accounts/%d', $id));
    }

    /**
     * @return Response
     */
    public function post(): Response
    {
        // TODO: Implement post() method.
    }
}
