export default{
	namespaced:true,
	state:{
		bibliografiax:''
	},
	mutations:{
		infoBibliografia(state,value){
			state.bibliografiax = value
			//console.log(state.bibliografiax)
		},
		updateBibliografia(state,value){
			state.bibliografiax = value
		},
		deleteBibliografia(state,value){
			state.bibliografiax = value
		}
	}
}