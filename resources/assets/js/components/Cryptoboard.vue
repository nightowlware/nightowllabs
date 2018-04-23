<template>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="jumbotron">
                <div style="display: flex">
                    <div>
                        Connected? {{ isConnected }}
                        <br>
                        Bitcoin: {{ prices.bitcoin }}
                        <br>
                        Litecoin: {{ prices.litecoin }}
                        <br>
                        Ethereum: {{ prices.ethereum }}
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
                        channels: [{"name": "ticker", "product_ids": ["BTC-USD", "ETH-USD", "LTC-USD"]}]
                    };
                    w.send(JSON.stringify(params));
                    this.isConnected = true;
                };

                return w;
            },

            parseTicker: function(data) {
                data = JSON.parse(data);
                if (data.product_id === "ETH-USD") {
                    this.prices.ethereum = data.price;
                } else if (data.product_id === "LTC-USD") {
                    this.prices.litecoin = data.price;
                } else if (data.product_id === "BTC-USD") {
                    this.prices.bitcoin = data.price;
                }
            },
        },

        computed: {
        },

        data() {
            return {
                // Note: for some hitherto unknown reason, the websocket object
                // is not reactive (in the Vuejs sense).
                webSocket: this.createWebSocket(),
                isConnected: false,
                prices: {
                    bitcoin: 0,
                    litecoin: 0,
                    ethereum: 0
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