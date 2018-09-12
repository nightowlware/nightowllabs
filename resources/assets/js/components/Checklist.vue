<template>
    <div v-if="id" id="item-ribbon" class="wide-ribbon list-group">
        {{ name }}
        <div
            class="dropdown show"
            v-for="item in items"
        >
            <a
                class="btn btn-lg list-group-item"
                :class="[{selected: isSelected(item.id)}]"
                v-on:click="itemSelected(item.id)"
                :id="'item_'+item.id"
            >
                {{item.text}}

                <span
                    class="selected h5"
                    :class="{'dropdown-toggle': isSelected(item.id)}"
                    :data-toggle="isSelected(item.id) ? 'dropdown' : false"
                    :aria-haspopup="isSelected(item.id) ? 'true' : 'false'"
                    :aria-expanded="isSelected(item.id) ? 'false' : false"
                ></span>

                <!--Popup menu-->
                <div :id="'item-popup-'+item.id" class="selected dropdown-menu" :aria-labelledby="'item-popup-'+item.id">
                    <a class="dropdown-item" @click="editClicked(item.id)">Edit Text</a>
                    <a class="dropdown-item" @click="deleteClicked(item.id)">Delete Item!</a>
                </div>
            </a>
        </div>

        <a id="item-adder" class="adder btn btn-lg list-group-item" @click="itemAdderClicked">
            <i class="fas fa-plus"></i>
            <input id="adder-item-input"
                   @keyup.enter="submitNewItem"
                   @blur="submitNewItem"
                   v-if="isItemInputEnabled"
                   class="form-control"
                   v-model="itemInput"
                   placeholder="Enter ChecklistItem">
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
                    this.name = "";
                    this.items = null;
                }
            },

            itemSelected(id) {
                this.currentItemId = id;
            },

            itemAdderClicked(event) {
                this.isItemInputEnabled = true;
                setTimeout(() => {$('#adder-item-input').focus();});
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
            },

            isSelected(id) {
                return id === this.currentItemId;
            },

            editClicked(id) {
                // // TODO: improve this!
                const text = prompt('Enter new text').substring(0, 2000);
                if (text !== '') {
                    axios.put('api/listitems/'+id, {text}).then((res) => {
                        this.fetchItems();
                    }).catch((err) => {console.warn(err)});
                }
            },

            deleteClicked(id) {
                axios.delete('api/listitems/'+id).then((res) => {
                    this.currentItemId = null;
                    this.fetchItems();
                }).catch((err) => {console.warn(err)});
            },
        },

        computed: {
        },

        data() {
            return {
                items: null,
                name: "",
                itemInput: '',
                isItemInputEnabled: false,
                currentItemId: null,
            };
        },

        watch: {
            // Whenver the chose checklist id changes (from the parent)
            id: function(newVal, oldVal) {
                this.fetchItems();
            }
        }
    }
</script>

<style>
    .wide-ribbon {
        min-width: calc(20% * 1.618 * 2);
    }
</style>
