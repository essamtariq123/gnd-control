<template>
    <div>
        <a class="navbar-brand" href="#!" data-toggle="modal" data-target="#exampleModal">
            GND CONTROL
        </a>

        <div class="modal" id="exampleModal" tabindex="-1" role="dialog">
            <div class="modal-dialog"  role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title">SUGGEST A FEATURE</h3>
                        <h6 class="modal-title">We love suggestions. if you have any ideas let us know.</h6>
                    </div>
                    <div class="modal-body">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1">Email</span>
                            </div>
                            <input type="text" v-model="email" class="form-control" placeholder="Email" aria-describedby="basic-addon1">
                        </div>
                        <div class="input-group">
                            <textarea class="form-control" v-model="suggestion" aria-label="Suggestion"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary">SUGGEST</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {

        data() {
            return {
                email: null,
                suggestion: null,
            }
        },
        mounted() {
            console.log('Component mounted.')
        },

        methods: {
            getSuggestionModal: function ()
            {
                console.log(this.$refs['modal'])
                this.$refs['modal'].show()
                // console.log()
                // let element = this.$refs.modal.$el
                // $(element).modal('show')
            }
        }
    }
</script>
