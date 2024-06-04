const ChainId = {
    PolygonTestnet: 137
}

const METAPAYMENT_ADDRESS = {
    [ChainId.PolygonTestnet]: "0x830017756Ce93b471f90A0502985766C9bb9bAF4"
}

const METACORE_ADDRESS = {
    [ChainId.PolygonTestnet]: "0xde432be2a3a93a83d45ff188cCa49fCE577fA8BF"
}

const RPC_URLS = {
    [ChainId.PolygonTestnet]: "https://polygon-pokt.nodies.app",
};

let _abi = [
    {
        "inputs": [
            {
                "internalType": "address",
                "name": "erc20",
                "type": "address"
            },
            {
                "internalType": "uint256",
                "name": "id",
                "type": "uint256"
            }
        ],
        "name": "getBalance",
        "outputs": [
            {
                "internalType": "uint256",
                "name": "",
                "type": "uint256"
            }
        ],
        "stateMutability": "view",
        "type": "function"
    },
];

let MetaPayment__factory = /** @class */ (function () {
    function MetaPayment__factory() {
    }
    MetaPayment__factory.createInterface = function () {
        return new ethers.utils.Interface(_abi);
    };
    MetaPayment__factory.connect = function (address, signerOrProvider) {
        return new ethers.Contract(address, _abi, signerOrProvider);
    };
    MetaPayment__factory.abi = _abi;
    return MetaPayment__factory;
}());

let _coreAbi = [
    {
        "inputs": [
            {
                "internalType": "address",
                "name": "",
                "type": "address"
            }
        ],
        "name": "getUserId",
        "outputs": [
            {
                "internalType": "uint256",
                "name": "",
                "type": "uint256"
            }
        ],
        "stateMutability": "view",
        "type": "function"
    },
];

let MetaCore__factory = /** @class */ (function () {
    function MetaCore__factory() {
    }
    MetaCore__factory.createInterface = function () {
        return new ethers.utils.Interface(_coreAbi);
    };
    MetaCore__factory.connect = function (address, signerOrProvider) {
        return new ethers.Contract(address, _coreAbi, signerOrProvider);
    };
    MetaCore__factory.abi = _coreAbi;
    return MetaCore__factory;
}());


export class Web3Utils {
    async getPaymentContract() {
        const provider = new ethers.providers.JsonRpcProvider(RPC_URLS[ChainId.PolygonTestnet]);
        const metaPayment = MetaPayment__factory.connect(
          METAPAYMENT_ADDRESS[ChainId.PolygonTestnet],
          provider
        )
        return metaPayment;
      }

    async getCoreContract() {
        const provider = new ethers.providers.JsonRpcProvider(RPC_URLS[ChainId.PolygonTestnet]);
        const metaCore = MetaCore__factory.connect(
          METACORE_ADDRESS[ChainId.PolygonTestnet],
          provider
        )
        return metaCore;
    }

    async getBalance(address) {
        const metaCore = await this.getCoreContract();
        const metaPayment = await this.getPaymentContract();
        const userId = await metaCore.getUserId(address);
        const dai = await metaPayment.getBalance("0x8f3Cf7ad23Cd3CaDbD9735AFf958023239c6A063", userId);
        const forcecoin = await metaPayment.getBalance("0x958Afa3285EbeAa23a6BBF26eA429Ee6225FBD77", userId);
        const energy = await metaPayment.getBalance("0xecfD832495080753197Bd3E3d9038FC8A5d850Bb", userId);

        return {
          userId: userId.toString(),
          dai: ethers.utils.formatEther(dai),
          forcecoin: ethers.utils.formatEther(forcecoin),
          energy: ethers.utils.formatEther(energy),
        };
    }
}
