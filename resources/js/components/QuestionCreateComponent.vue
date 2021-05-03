<template>
    <div class="container">
        <div class="row justify-content-center">
            <div  v-bind:class="$mq | mq({ phone: 'formContainer_phone', tablet: 'formContainer_tablet', other: 'formContainer_pc' })">
                <form v-on:submit.prevent="submit">
                    <div class="form-group colum">
                        <label for="QuestionText" class="col-sm-9 col-form-label">問題文</label>
                        <input type="text" class="col-sm-9 form-control" id="QuestionText" v-model="question.QuestionText">
                        <p class="error">
                            {{ Validation.QuestionText }}
                        </p>
                    </div>
                    <div class="form-group colum">
                        <label for="Answer" class="col-sm-9 col-form-label">答え</label>
                        <input type="text" class="col-sm-9 form-control" id="Answer" v-model="question.Answer">
                        <p class="error">
                            {{ Validation.Answer }}
                        </p>
                    </div>
                    <div class="form-group colum">
                        <label for="Category1" class="col-sm-9 col-form-label">カテゴリー1</label>
                        <input type="text" class="col-sm-9 form-control" id="Category1" v-model="question.Category1">
                        <p class="error">
                            {{ Validation.Category1 }}
                        </p>
                    </div>
                    <div class="form-group colum">
                        <label for="Category2" class="col-sm-9 col-form-label">カテゴリー2</label>
                        <input type="text" class="col-sm-9 form-control" id="Category2" v-model="question.Category2">
                    </div>
                    <div class="form-group colum">
                        <label for="Category3" class="col-sm-9 col-form-label">カテゴリー3</label>
                        <input type="text" class="col-sm-9 form-control" id="Category3" v-model="question.Category3">
                    </div>
                    <button type="submit" class="btn btn-primary">登録</button>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
    import api from "../../api/index";

    export default {
        data: function () {
           return {
                question: {
                    QuestionText:"",
                    Answer:"",
                    Category1:"",
                    Category2:"",
                    Category3:""
                },
                Validation:{
                    QuestionText: "",
                    Answer: "",
                    Category1:""
                }
           }
       },
       computed:{
           createContainer() {
            return this.$mq === 'phone' ? 'createContainer_phone' : 'createContainer'
        }
       },
       methods: {
           submit() {
               if(this.validate()){
                   this.register();
               }
           },
           validate() {
               let correctFlag = true;

               if(this.question.QuestionText === ""){
                   correctFlag = false;
                   this.Validation.QuestionText = "問題名を入力してください";
               }else{
                   this.Validation.QuestionText = "";
               }

               if(this.question.Answer === ""){
                   correctFlag = false;
                   this.Validation.Answer = "答えをを入力してください";
               }else{
                   this.Validation.Answer = "";
               }

               if(this.question.Category1 === ""){
                   correctFlag = false;
                   this.Validation.Category1 = "カテゴリー名は最低一つ入力してください";
               }else{
                   this.Validation.Category1 = "";
               }

                return correctFlag;
           },
           register() {
               api({
                    method : 'post',
                    url    : '/api/questions',
                    data : this.question
                })
                .then((res) => {
                    if(res.success){
                        console.log(res);
                        this.$router.push({name: 'question.list'})
                    }else{
                        console.log(res);
                        alert(res.errMsg);
                    }
                })
           }
       }
    }
</script>

<style scoped>
    .formContainer_pc{
        min-width:600px;
        max-width:1000px;
        width:70%
    }
    .formContainer_tablet{
        max-width:900px;
        width:80%
    }
    .formContainer_phone{
        max-width:300px;
        width:80%
    }
    .error {
        color:red;
    }
</style>