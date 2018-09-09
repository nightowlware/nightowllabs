<template>
    <div class="list-group">
        {{ name }}
        <a
            class="click-hover list-group-item"
            v-for="item in items"
            v-bind:id="'item_'+item.id"
            v-on:click="itemSelected(item.id)">

            {{item.text}}
        </a>
        <a v-if="name!==null" id="item-adder" class="adder btn btn-lg list-group-item">
            <i class="fas fa-plus"></i>
        </a>
    </div>
</template>

<script>
    export default {
        props: ['id'],

        components: {
        },

        mounted() {
            this.fetchItems();
        },

        methods: {
            fetchItems() {
                if (this.id) {
                    axios.get('api/checklists/' + this.id).then((res) => {
                        this.name = res.data.name;
                        this.items = res.data.list_items;
                    }).catch((err) => {console.warn(err)});
                }
            },

            itemSelected(id) {
                // console.log('Selected item' + id);
            }
        },

        computed: {
        },

        data() {
            return {
                items: null,
                name: null,
            };
        },

        watch: {
            // Whenver the chose checklist id changes (from the parent)
            id: function(newVal, oldVal) {
                // console.log("ID changed: ", oldVal, newVal);
                this.fetchItems();
            }
        }
    }
</script>

<style>
</style>
