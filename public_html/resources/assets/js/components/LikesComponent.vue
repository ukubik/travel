<template lang="html">

    <div class="row">
        <div class="col-auto pr-0" v-if="user_liked">
            <img src="/img/likes/like_on.png" alt="like" class="img-fluid" style="max-height:35px">
        </div>
        <div class="col-auto pr-0 like" v-else>
            <img src="/img/likes/like.png" alt="like" class="img-fluid" style="max-height:35px" @click="articleLike(1)">
        </div>
        <div class="col-auto d-flex align-items-center" :class="{ 'text-danger': red_text, 'text-success': green_text }">
            {{ likes - dislikes }}
        </div>
        <div class="col-auto pl-0" v-if="user_disliked">
            <img src="/img/likes/dislike_on.png" alt="dislike" class="img-fluid" style="max-height:35px">
        </div>
        <div class="col-auto pl-0 like" v-else>
            <img src="/img/likes/dislike.png" alt="dislike" class="img-fluid" style="max-height:35px" @click="articleLike(-1)">
        </div>
    </div>

</template>

<script>
export default {
    props: [
        'user',
        'article'
    ],

    data() {
        return {
            local_article: this.article,
            user_liked: false,
            user_disliked: false,
        }
    },

    computed: {
        likes() {
            return this.local_article.article_likes ? this.local_article.article_likes.length : 0;
        },

        dislikes() {
            return this.local_article.article_dislikes ? this.local_article.article_dislikes.length : 0;
        },

        red_text() {
            return Math.sign(this.likes - this.dislikes) === -1;
        },

        green_text() {
            return Math.sign(this.likes - this.dislikes) === 1;
        },
    },

    watch: {

    },

    mounted() {
        this.userLiked();
        this.userDisliked();
    },

    methods: {
        userLiked() {
            $.each(this.local_article.article_likes, (index, values) => {

                if(values['user_id'] === this.user.id) {
                    this.user_liked = true;
                    this.user_disliked = false;
                    return false;
                }
            });
        },

        userDisliked() {
            $.each(this.local_article.article_dislikes, (index, values) => {

                if(values['user_id'] === this.user.id) {
                    this.user_disliked = true;
                    this.user_liked = false;
                    return false;
                }
            });
        },

        articleLike(data) {
            if(this.user === 0) {
                $('#auth').modal('show');
                return;
            } else {
                axios.post('/article-like/store/' + this.article.id, {
                    data: data,
                    user_id: this.user.id,
                }).then(response => {
                    this.local_article = response.data;
                    this.userLiked();
                    this.userDisliked();
                });
            }
        }
    }
}
</script>

<style lang="css">
.like img {
    cursor: pointer;
}
</style>
