<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        Twitter <a v-if="this.username" :href="urlProfile" target="_blank">@{{username}}</a>
                    </div>

                    <div class="card-body">
                        <div v-if="isLoading">Loading Tweets...</div>

                        <tweet-component v-for="(tweet, index) in tweetsToShow" :key="index" :is-owner="isOwner" :tweet="tweet"/>
                        <button v-if="pagination.currentLimit < pagination.total" @click="pagination.currentLimit += pagination.step" class="btn btn-light float-right">Load More</button>

                        <error-component v-for="(error, index) in errors" :key="index" level="danger" :code="error.code" :message="error.message"/>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>

    import TweetComponent from './TweetComponent.vue';
    import ErrorComponent from './ErrorComponent.vue';

    export default {
        data: function() {
            return {
                userId: document.getElementById('current_user_id').value,
                username: '',
                isOwner: false,
                tweets: [],
                errors: [],
                isLoading: true,
                pagination: {
                    total: 0,   // Total Tweets
                    step: 5,
                    currentLimit: 5,
                }
            };
        },
        mounted() {
            console.log('TwitterFeedComponent mounted.');

            let componentData = this;
            axios.get(`${APP.baseUrl}/authors/tweets/${this.userId}`)
                .then(function (response) {
                    componentData.username = response.data.username;
                    componentData.isOwner = response.data.isOwner;
                    componentData.tweets = typeof(response.data.tweets)!=='undefined' ? response.data.tweets : [];
                    componentData.errors = typeof(response.data.errors)!=='undefined' ? response.data.errors : [];
                    componentData.pagination.total = componentData.tweets.length;
                })
                .catch(function (error) {
                    alert(`Error retrieving data from Twitter, please refresh the page.\n${error}`);
                    console.log(error);
                })
                .then(function () {
                    componentData.isLoading = false;
                });
        },
        computed: {
            urlProfile: function(){
                return `https://twitter.com/${this.username}`;
            },
            tweetsToShow: function(){
                return _.slice(this.tweets, 0, this.pagination.currentLimit);
            },
        },
        components: {
            TweetComponent,
            ErrorComponent
        }
    }
</script>
