<template>
    <div>
        <categories :nodes="cats" :label="label" :id="id"></categories>
    </div>
</template>

<script>
    export default {
        mounted() {
            axios.get('/category')
                .then(response => {
                    console.log(response);
                    let item = response.data[0];
                    this.cats = item.list;
                    this.label = item.name;
                    this.id = item.id;
                });

        },
        data() {
            return {
                cats: null,
                label: null,
                id: null
            }
        }
    }
</script>