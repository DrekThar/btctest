<?php


namespace App\Components;


class XornService
{

    private $apiHelper;

    /**
     * XornService constructor.
     * @param string $host
     * @param integer $port
     * @param string $login
     * @param string $password
     */
    public function __construct($host, $port, $login, $password)
    {
        $this->apiHelper = new ApiHelper("$host:$port", ['auth' => [$login, $password]]);
    }

    /**
     * Returns an object containing various state info regarding blockchain processing
     * @return array
     */
    public function getBlockchainInfo()
    {
        return $this->apiHelper->post('/', 'getblockchaininfo', time());
    }

    /**
     * List account balances
     * @param integer $minConfirmations include transactions with at least this many confirmations
     * @return array
     */
    public function listAccounts($minConfirmations)
    {
        return $this->apiHelper->post('/', 'listaccounts', time(), [$minConfirmations]);
    }

    /**
     * Returns up to 'count' most recent transactions skipping the first 'from' transactions for account 'account'
     * @param string $account
     * @param integer $count
     * @param integer $skip
     * @return array
     */
    public function listTransactions($account, $count, $skip)
    {
        return $this->apiHelper->post('/', 'listtransactions', time(), [$account, $count, $skip]);
    }
}