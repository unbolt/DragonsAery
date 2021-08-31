<template>
    <div>
        <div>
            <VueMultiselect 
                v-model="value" 
                placeholder="Search for item" 
                label="en_name" 
                track-by="int_id" 
                :options="options" 
                @search-change="asyncFind"
            >

                <template #singleLabel="{option}">
                    <ItemTooltip :item="option" />
                </template>
                
                <template #option="{option}">
                    <ItemTooltip :item="option" />
                </template>

                <template v-slot:noResult>No item found.</template>
            </VueMultiselect>

            <pre class="language-json"><code>{{ value  }}</code></pre>
        </div>
    </div>
</template>

<script>
import VueMultiselect from 'vue-multiselect'
import ItemTooltip from '@/Components/ItemTooltip.vue'

export default {
    components: { 
        VueMultiselect,
        ItemTooltip
    },
    data () {
        return {
            value: null,
            options: [],
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

<style src="vue-multiselect/dist/vue-multiselect.css"></style>