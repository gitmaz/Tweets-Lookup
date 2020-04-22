<template>
    <div class="container">
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            This Application uses Vue.js to render queried tweets retrieved from twitter api!
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">List of tweets referring Kidspot (@KidspotSocial) with hashtags and mentions:</div>

                    <div class="card-body">
                        <TwitsList :twits="twits"></TwitsList>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import TwitsList from "./TwitsList";

    export default {
        components: {TwitsList: TwitsList},
        data() {
            return {
                twits: []
            }
        },
        created() {
            let uri = 'http://localhost:8000/api/v1/search-referring-tweets?auth_token=5ueWJbSvd3Du6StxZWx5cdx1';
            this.axios.get(uri).then(response => {
                this.twits = response.data;
            });

            /*
            axios
                .get(uri)
                .then(response => (this.twits =  response.data.statuses))
                .catch(error => console.log(error))
             */

        },
        mounted() {
            console.log('Component mounted.')
        },
    }
</script>
