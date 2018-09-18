<template>
    <div v-if="id" id="item-ribbon" class="wide-ribbon list-group">
        <div>
            {{ name }}:
            <span v-if="isChecklistCompleted" style="color: var(--success)" >Checklist Completed!
            </span>
        </div>

        <div
            class="show"
            v-for="item in items"
        >
            <a
                class="flexy-center btn btn-lg list-group-item"
                :class="[{selected: isSelected(item.id)}]"
                v-on:click="itemSelected(item.id)"
                :id="'item_'+item.id"
            >
                <span class="elide" :class="{checked: item.checked}">
                    {{item.text}}
                </span>

                <span
                    class="px-1 py-0 my-0 inline-block selected h5"
                    v-if="isSelected(item.id)"
                    :class="{'dropdown-toggle': isSelected(item.id)}"
                    :data-toggle="isSelected(item.id) ? 'dropdown' : false"
                    :aria-haspopup="isSelected(item.id) ? 'true' : 'false'"
                    :aria-expanded="isSelected(item.id) ? 'false' : false"
                ></span>

                <div style="margin-left: auto" class="form-check">
                    <input class="item-checkbox form-check-input" type="checkbox"
                           v-model="item.checked" :id="'item_completed_'+item.id">
                    <label class="form-check-label" :for="'item_completed_'+item.id">
                    </label>
                </div>

                <!--Popup menu-->
                <div :id="'item-popup-'+item.id" class="position-absolute selected dropdown-menu" :aria-labelledby="'item-popup-'+item.id">
                    <a class="dropdown-item" @click="shiftUp(item.id)">Shift Up</a>
                    <a class="dropdown-item" @click="shiftDown(item.id)">Shift Down</a>
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
                    this.items = [];
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

            shift(id, direction) {
                axios.patch('api/listitems/'+id+'/shift'+direction).then((res) => {
                    this.fetchItems();
                }).catch((err) => {console.warn(err)});
            },

            shiftUp(id) {
                this.shift(id, 'Desc');
            },

            shiftDown(id) {
                this.shift(id, 'Asc');
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
            isChecklistCompleted() {
                return this.items.length > 0 && this.items.every((i) => i.checked);
            }
        },

        data() {
            return {
                items: [],
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

    .item-checkbox {
        margin-top: 0;
        width: 25px;
        height: 25px;
    }

    .checked {
        text-decoration: line-through;
        color: var(--success);
    }

</style>
