<template>
	<svg width="150" height="50">
	  	<rect width="150" height="50" rx="15" ry="15" style="fill:black;stroke-width:2;stroke:rgb(0,0,0)" />
    	<circle cx="25" cy="25" r="20" stroke="black" stroke-width="3" fill="red" v-if="color=='red'"/>
    	<circle cx="75" cy="25" r="20" stroke="black" stroke-width="3" fill="yellow" v-if="color=='yellow'" />
    	<circle cx="125" cy="25" r="20" stroke="black" stroke-width="3" fill="lime" v-if="color=='lime'" />
	</svg>
</template>
<script>
    export default {
        mounted() {
            // console.log('Semaforo Component mounted.');
        },
        props: ['color'],
        data(){
        	return {
        		color_1: false,
        		color_2: false,
        		color_3: false,
        	}
        },
	};	
</script>