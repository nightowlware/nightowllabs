<template>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="jumbotron">
                <div style="display: flex">
                    <div>
                        Connected? {{ isConnected }}
                        <br>
                        Bitcoin: {{ cryptos.bitcoin.price }}
                        <br>
                        Litecoin: {{ cryptos.litecoin.price }}
                        <br>
                        Ethereum: {{ cryptos.ethereum.price }}
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
                if (data.product_id === "ETH-USD") {
                    this.cryptos.ethereum.price = data.price;
                } else if (data.product_id === "LTC-USD") {
                    this.cryptos.litecoin.price = data.price;
                } else if (data.product_id === "BTC-USD") {
                    this.cryptos.bitcoin.price = data.price;
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
</style>