<template>
    <div class="border border-gray-200 mb-4 p-4 rounded-lg" v-if="character">
        <img :src="'/img/nation/' + character.nation + '.jpg'" :alt="character.nation" width="15" class="inline" />
        {{ character.charname }}
    </div>
</template>

<script>

export default {
    props: ['character'],

    data () {
        return {
            missions: Object,
        }
    },
    methods: {
        asyncFind (query) {
            if(query.length > 2) {
                axios
                    .get('/item/search/' + query)
                    .then(response => (this.options = Object.values(response.data)));
            }

        }
    }
}
</script>