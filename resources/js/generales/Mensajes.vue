<template>
	<div>
		<div v-if="(habilitar_alert==true)" :class="['alert','pt-2','pb-2','pl-3','mb-2',clase_alert]">
			{{ mensaje }}
		</div>
	</div>
</template>

<script>
	export default{
		props:['mensaje','habilitar_alert','clase_alert']
	};
</script>