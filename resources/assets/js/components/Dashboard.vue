<template>
    <div class="row justify-content-center">
        <div class="col-md-12">

            <!--Render n quotes, where n can be passed to "fetchQuotes()"-->
            <!--<div class="jumbotron">-->
                <!--<div style="display: flex">-->
                    <!--<div>-->
                        <!--<span v-html="quoteWall"></span>-->
                    <!--</div>-->
                    <!--<div class="fill">-->
                        <!--<img :src="require('../../images/flask.png')"/>-->
                    <!--</div>-->
                <!--</div>-->
            <!--</div>-->

            <!--Render all published blog posts-->
            <div v-for="blog in blogPosts" class="jumbotron">
                <h4>{{blog.title}}</h4>
                <p><small>{{formatDate(blog.published_date)}}</small></p>
                <div v-html="blog.body"></div>
            </div>

        </div>
    </div>
</template>

<script>
    export default {
        mounted() {
            // this.fetchQuotes(3);
            this.fetchBlogPosts();
        },

        methods: {
            fetchBlogPosts() {
                axios.get('/api/blogposts').then((res) => {
                    this.blogPosts = res.data;
                });
            },

            fetchQuotes(num) {
                let promiseArray = Array(num).fill('/api/quote').map(url => axios.request(url));

                axios.all(promiseArray).then((responses) => {
                    let quotes = Array.from(new Set(responses.map(e => (e.data.quote + "&nbsp&nbsp--" + e.data.author))));
                    this.quoteWall = quotes.join('<br><br>');
                }).catch((error) => {
                    console.error(error);
                });
            },

            paddedQuote(q) {
                return "<br><br>" + q;
            },

            formatDate(d) {
                return new Date(d).toLocaleDateString('en-US');
            }
        },

        data() {
            return {
                quoteWall: "",
                blogPosts: []
            }
        },

        computed: {
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

    p small {
        color: #fff;
    }
</style>
