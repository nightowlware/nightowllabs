<template>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="jumbotron">
                <div style="display: flex">
                    <div>
                        <h1>Bitcoin: {{ cryptos.bitcoin.price | toCurrency}}</h1>
                        <h1>Litecoin: {{ cryptos.litecoin.price | toCurrency}}</h1>
                        <h1>Ethereum: {{ cryptos.ethereum.price | toCurrency}}</h1>
                    </div>
                    <div>
                        <h1>
                            <i class="hugefont far"
                               :class="[isConnected ? 'fa-check-circle' : 'fa-times-circle', isConnected ? 'green' : 'red']">
                            </i>
                        </h1>

                        <!--<font-awesome-icon :icon="true ? checkedIcon : uncheckedIcon" :size="size" />-->
                    </div>
                    <!--<div class="fill">-->
                        <!--<img :src="require('../../images/flask.png')"/>-->
                    <!--</div>-->
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        mounted() {
            this.webSocket = this.createWebSocket();
        },

        methods: {
            createWebSocket: function() {
                let w = new WebSocket("wss://ws-feed.gdax.com");

                w.onclose = () => { this.isConnected = false; };

                w.onmessage = (msg) => {
                    this.parseTicker(msg.data);
                };

                w.onopen = () => {
                    let params = {
                        type: "subscribe",
                        channels: [{"name": "ticker", "product_ids": this.getAllSymbols() }]
                    };
                    w.send(JSON.stringify(params));
                    this.isConnected = true;
                };

                return w;
            },

            parseTicker: function(data) {
                data = JSON.parse(data);

                for (let c of Object.keys(this.cryptos)) {
                    if (data.product_id === this.cryptos[c].symbol) {
                        this.cryptos[c].price = data.price;
                    }
                }
            },

            getAllSymbols: function() {
                let arr = [];
                for (let c of Object.keys(this.cryptos)) {
                    if (this.cryptos[c].symbol) {
                        arr.push(this.cryptos[c].symbol);
                    }
                }
                return arr;
            }
        },

        computed: {
        },

        data() {
            return {
                // Note: for some hitherto unknown reason, the websocket object
                // is not reactive (in the Vuejs sense).
                webSocket: null,
                isConnected: false,
                cryptos: {
                    bitcoin: { symbol: "BTC-USD", price: 0 },
                    litecoin: { symbol: "LTC-USD", price: 0 },
                    ethereum: { symbol: "ETH-USD", price: 0 },
                }
            };
        },

        watch: {
        }
    }
</script>

<style>
    .fill {
        display: flex;
        justify-content: center;
        align-items: center;
        overflow: hidden
    }

    .fill img {
        object-fit: cover;
        width: 50%;
        /*height: auto;*/
    }

    .green {
        color: green;
    }

    .red {
        color: red;
    }

    .hugefont {
        font-size: 8rem;
    }
</style>
