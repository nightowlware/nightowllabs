<template>
    <div class="list-group">
        {{ name }}
        {{ id }}
        <a
            class="click-hover list-group-item"
            v-for="item in items"
            v-bind:id="'item_'+item.id"
            v-on:click="itemSelected(item.id)">

            {{item.text}}
        </a>

        <a v-if="name!==null "id="item-adder" class="adder btn btn-lg list-group-item" @click="itemAdderClicked">
            <i class="fas fa-plus"></i>
            <input id="adder-item-input"
                   @keyup.enter="submitNewItem"
                   @blur="submitNewItem"
                   v-if="isItemInputEnabled"
                   class="form-control"
                   v-model="itemInput"
                   placeholder="Enter Checklist Item"
            >
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
                        this.items = res.data.list_items;
                        this.name = res.data.name;
                    }).catch((err) => {console.warn(err)});
                } else {
                    this.name = null;
                    this.items = null;
                }
            },

            itemSelected(id) {
                // console.log('Selected item' + id);
            },

            itemAdderClicked(event) {
                setTimeout(() => {$('#adder-item-input').focus();});
                this.isItemInputEnabled = true;
            },

            submitNewItem() {
                if (this.isItemInputEnabled) {
                    // truncate input
                    const text = this.itemInput.substring(0, 2000);
                    if (text && text !== "") {
                        axios.post('api/listitems', {text, checklist_id: this.id}).then((res) => {
                            this.fetchItems();
                            this.itemInput = '';
                        }).catch((err) => {console.warn(err)});
                    }
                    this.isItemInputEnabled = false;
                }
            }
        },

        computed: {
        },

        data() {
            return {
                items: null,
                name: null,
                itemInput: '',
                isItemInputEnabled: false,
            };
        },

        watch: {
            // Whenver the chose checklist id changes (from the parent)
            id: function(newVal, oldVal) {
                console.log("ID changed: ", oldVal, newVal);
                this.fetchItems();
            }
        }
    }
</script>

<style>
</style>
