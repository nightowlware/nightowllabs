<template>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="jumbotron">
                <div style="display: flex; justify-content: space-between">
                    <div>
                        <h1 v-for="(val, key) in sort(cryptos)"> {{key}} : {{ val.price | toCurrency }}</h1>
                        <!--<h1>Bitcoin: {{ cryptos.bitcoin.price | toCurrency}}</h1>-->
                        <!--<h1>Litecoin: {{ cryptos.litecoin.price | toCurrency}}</h1>-->
                        <!--<h1>Ethereum: {{ cryptos.ethereum.price | toCurrency}}</h1>-->
                    </div>
                    <div class="flex-center">
                        <h1>
                            <i class="hugefont fa"
                               :class="[isConnected ? 'fa-check-circle' : 'fa-times-circle', isConnected ? 'green' : 'red']">
                            </i>
                        </h1>
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
            createWebSocket() {
                let w = new WebSocket("wss://ws-feed.gdax.com");

                w.onclose = () => { this.isConnected = false; };

                w.onmessage = (msg) => {
                    let data = JSON.parse(msg.data);
                    if (data.type === "heartbeat") {
                        return;
                    }
                    this.parseTicker(data);
                };

                w.onopen = () => {
                    let params = {
                        type: "subscribe",
                        channels: [{"name": "ticker", "product_ids": this.getAllSymbols() },
                                   {"name": "heartbeat", "product_ids": this.getAllSymbols()}]
                    };
                    w.send(JSON.stringify(params));
                    this.isConnected = true;
                };

                return w;
            },

            parseTicker(data) {
                for (let c of Object.keys(this.cryptos)) {
                    if (data.product_id === this.cryptos[c].symbol) {
                        this.cryptos[c].price = data.price;
                    }
                }
            },

            getAllSymbols() {
                let arr = [];
                for (let c of Object.keys(this.cryptos)) {
                    if (this.cryptos[c].symbol) {
                        arr.push(this.cryptos[c].symbol);
                    }
                }
                return arr;
            },

            sort(cryptos) {
                return Object.keys(cryptos).sort().reduce((a, v) => {
                    a[v] = cryptos[v];
                    return a;
                }, {});
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
                    Bitcoin: { symbol: "BTC-USD", price: 0 },
                    Litecoin: { symbol: "LTC-USD", price: 0 },
                    Ethereum: { symbol: "ETH-USD", price: 0 },
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
        margin-left: auto;
        margin-right: auto;
        font-size: 4rem;
    }
</style>
