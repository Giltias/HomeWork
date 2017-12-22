<template>
    <ul class="list-unstyled">
        <li>
            <a :href="'/category/filter/' + id">{{ label }}</a>
            <categories
                    v-for="node in nodes"
                    :nodes="node.list"
                    :label="node.name"
                    :id="node.id"
                    :key="node.id"
            ></categories>
        </li>
    </ul>
</template>

<script>
    export default {
        props: [ 'label', 'nodes', 'id' ],
        name: 'categories'
    }
</script>