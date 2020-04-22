<template>
    <b-list-group flush id="ul-tweets-list">
        <b-list-group-item v-for="twit in twits" :key="twit.id">
            {{ twit.text }}
            <div><b>hashtags:</b></div>
            <b-list-group id="ul-hashtags-list">
                <b-list-group-item v-for="(hashtag, hashtag_index) in twit.entities.hashtags" :key="hashtag_index">
                    {{ hashtag.text }}
                </b-list-group-item>
            </b-list-group>
            <div><b>mentions:</b></div>
            <b-list-group id="ul-mentions-list" style="width:30%">
                <b-list-group-item v-for="(mention, mention_index) in twit.entities.user_mentions" :key="mention_index">
                    @{{ mention.screen_name }}
                </b-list-group-item>
            </b-list-group>
        </b-list-group-item>
    </b-list-group>
</template>
<script>
    export default {
        props: [
            'twits'
        ],
        computed: {
            items() {
                let items = []
                return items
            }
        },
        mounted() {
            console.log('Component tweet list  mounted.')
        }
    }
</script>
