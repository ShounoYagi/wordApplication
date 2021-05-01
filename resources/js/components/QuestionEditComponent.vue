<template>
    <div class="container">
        <div class="row justify-content-center">
            <div v-bind:class="$mq | mq({ phone: 'formContainer_phone', tablet: 'formContainer_tablet', other: 'formContainer_pc' })">
                <form v-on:submit.prevent="submit">
                    <div class="form-group column">
                        <label for="QuestionText" class="col-sm-9 col-form-label">問題文</label>
                       <input type="text" class="col-sm-9 form-control"  id="QuestionText" v-model="question.QuestionText">
                       <p class="error">
                            {{ Validation.QuestionText }}
                        </p>
                    </div>
                    <div class="form-group column">
                        <label for="Answer" class="col-sm-9 col-form-label">答え</label>
                        <input type="text" class="col-sm-9 form-control" id="Answer" v-model="question.Answer">
                        <p class="error">
                            {{ Validation.Answer }}
                        </p>
                    </div>
                    <div class="form-group column">
                        <label for="Category1" class="col-sm- col-form-label">カテゴリー1</label>
                        <input type="text" class="col-sm-9 form-control" id="Category1" v-model="question.Category1">
                        <p class="error">
                            {{ Validation.Category1 }}
                        </p>
                    </div>
                    <div class="form-group column">
                        <label for="Category2" class="col-sm-9 col-form-label">カテゴリー2</label>
                        <input type="text" class="col-sm-9 form-control" id="Category2" v-model="question.Category2">
                    </div>
                    <div class="form-group column">
                        <label for="Category3" class="col-sm-9 col-form-label">カテゴリー3</label>
                        <input type="text" class="col-sm-9 form-control" id="Category3" v-model="question.Category3">
                    </div>
                    <button type="submit" class="btn btn-primary">編集完了</button>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
    import api from "../../api/index";

    export default {
        
        props: {
            questionId: String
        },
        data: function () {
            return {
                question: {},
                Validation:{
                    QuestionText: "",
                    Answer: "",
                    Category1:""
                }
            }
        },
        methods: {
            getQuestion() {
                 api({
                        method : 'get',
                        url    : '/api/questions/' + this.questionId,
                    })
                    .then((res) => {
                        this.question = res;
                    });
            },
            submit() {
                 if(this.validate()){
                   this.update();
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
           update() {
               api({
                        method : 'put',
                        url    : '/api/questions/' + this.questionId,
                        data: this.question,
                    })
                   .then((res) => {
                       this.$router.push({name: 'question.list'});
                   });
           }
        },
        created() {
            this.getQuestion();
        }
    }
</script>

<style lang="scss">
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
    .col-form-label{
        padding-left: 0;
    }
</style>