<template>
    <div :id="tweet.id" class="row justify-content-left tweet">
        <div class="col-md-12">
            <div class="card">
                <div v-if="isOwner" class="card-header">
                    <button v-show="!tweet.hidden" @click="hideTweet" type="button" class="btn btn-success btn-sm float-right">Hide</button>
                    <button v-show="tweet.hidden" @click="showTweet" type="button" class="btn btn-danger btn-sm float-right">Unhide</button>
                </div>
                <div class="card-body tweet__content">
                    {{tweet.text}}
                </div>
                <!-- <div class="card-footer text-muted tweet__footer">
                    {{tweet.created_at}}
                </div> -->
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['tweet', 'isOwner'],
        methods: {
            hideTweet: function (event) {
                this.saveTweetVisibily(true);
            },
            showTweet: function (event) {
                this.saveTweetVisibily(false);
            },
            saveTweetVisibily: function (hide) {
                let componentData = this;
                axios.post(`${APP.baseUrl}/authors/tweet/${this.tweet.id_str}`, {
                        hide: hide,
                    })
                    .then(function (response) {
                        console.log(`${componentData.tweet.id_str} updated`,response);
                        if (response.data.success) {
                            componentData.tweet.hidden = hide;
                        } else {
                            alert('Something went worng, please try again.');
                        }
                    })
                    .catch(function (error) {
                        alert(`Error updating Tweet, please refresh the page.\n${error}`);
                        console.log(error);
                    });
            }
        }
    }
</script>
