<?php

require_once('../php-client/autoload.php');


use BlockCypher\Auth\SimpleTokenCredential;
use BlockCypher\Rest\ApiContext;
use BlockCypher\Client\AddressClient;
use BlockCypher\Client\TXClient;
use BlockCypher\Api\TX;

$config = array();
//$config["btc.pubkey"] = "03c87570fdabfbd0eb05a0c8ac0d686123026bd23f8a5c088c1ebff9016049a01b"; // Master BTC Public Key.   user input to ac  
//$config["btc.privkey"] = "f583061b12dd3d1b866975bf512c3ee136b9c17583022b1db8cd462b544bcd51"; // Master BTC Private Key.  user input to ac  
//$config["btc.addr"] = "mqh49RvTAiJ61SorTZVtANfRA4B4viRH8B"; // Master BTC Address. user input to ac  
//$config["btc.blockcypher.apitoken"] = "cd5222c524f341c3bb80fb185c19fbfe"; //dont change

//$apiContext = new \BlockCypher\Rest\ApiContext(new \BlockCypher\Auth\SimpleTokenCredential($config["btc.blockcypher.apitoken"]));

class MyWallet {
	private $apiContext, $apiContextNoToken;

	public function __construct($addr) {
		global $config;
		$config["btc.pubkey"] = "03c87570fdabfbd0eb05a0c8ac0d686123026bd23f8a5c088c1ebff9016049a01b";
		$config["btc.blockcypher.apitoken"] = "cd5222c524f341c3bb80fb185c19fbfe"; // BlockCypher API Token
		$config["btc.addr"] = $addr;
		$this->apiContext = ApiContext::create(
		    'test3', 'btc', 'v1',
		    new SimpleTokenCredential($config["btc.blockcypher.apitoken"]),
		    array('log.LogEnabled' => true, 'log.FileName' => 'BlockCypher.log', 'log.LogLevel' => 'DEBUG')
		);

		// Non-POST requests doesn't need token which avoids hitting limit
		$this->apiContextNoToken = ApiContext::create(
		    'test3', 'btc', 'v1',
		    new SimpleTokenCredential(""),
		    array('log.LogEnabled' => true, 'log.FileName' => 'BlockCypher.log', 'log.LogLevel' => 'DEBUG')
		);
	}

	public function setMasterAddr($addr) {
		$config["btc.addr"] = $addr;
	}

	// Getting receiving address
	public function getRecvAddr() {
		// Using hard coded address
		// If you are using HD (Hierarchical Deterministic) Wallet, please modify accordingly
		return $this->getMasterAddr();
	}


	public function getMasterAddr() {
		global $config;
		return $config["btc.addr"];
	}

	public function getMasterAddrTransactions() {
		return $this->getAddrTransactions($this->getMasterAddr());
	}

	public function getMasterAddrFullTransactions() {
		return $this->getAddrFullTransactions($this->getMasterAddr());
	}
	
	public function getAddrTransactions($addr) {
		$addressClient = new AddressClient($this->apiContextNoToken);
		$address = $addressClient->get($addr);
		return $address->txrefs;
	}
	
	public function getAddrFullTransactions($addr) {
		$addressClient = new AddressClient($this->apiContextNoToken);
		$address = $addressClient->getFullAddress($addr);
		return $address->txs;
	}

	public function getAddrBalance($addr) {
		$addressClient = new AddressClient($this->apiContextNoToken);
		$addressBalance = $addressClient->getBalance($addr);
		return $addressBalance->final_balance;
	}

	public function getMasterAddrBalance() {
		return $this->getAddrBalance($this->getMasterAddr());
	}

	public function sendPayment($btcAddress, $btcPrivateKeys, $satoshi) {
		global $config;
		$config["btc.privkey"] = $btcPrivateKeys;
		$tx = new TX();

		// Tx inputs
		$input = new \BlockCypher\Api\TXInput();
		$input->addAddress($this->getMasterAddr());
		$tx->addInput($input);
		// Tx outputs
		$output = new \BlockCypher\Api\TXOutput();
		$output->addAddress($btcAddress);
		$tx->addOutput($output);
		// Tx amount
		$output->setValue($satoshi); // Satoshis

		$txClient = new TXClient($this->apiContext);
		$txSkeleton = $txClient->create($tx);
		$privateKeys = array($config["btc.privkey"]);
		$txSkeleton = $txClient->sign($txSkeleton, $privateKeys);
		
		$txSkeleton = $txClient->send($txSkeleton);
		
		return $txSkeleton->tx->hash;
	}

}

?>

