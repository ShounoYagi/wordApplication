<template>
    <div class="container">
        <div class="row justify-content-center">
            <div  v-bind:class="$mq | mq({ phone: 'formContainer_phone', tablet: 'formContainer_tablet', other: 'formContainer_pc' })">
                <form>

                    <div class="form-group column">
                        <label for="QuestionText" class="col-sm-9 col-form-label">問題文</label>
                       <input type="text" class="col-sm-9 form-control" readonly id="QuestionText" v-model="question.QuestionText">
                    </div>
                    <div class="form-group column">
                        <label for="Answer" class="col-sm-9 col-form-label">答え</label>
                        <input type="text" class="col-sm-9 form-control" readonly id="Answer" v-model="question.Answer">
                    </div>
                    <div class="form-group column">
                        <label for="Category1" class="col-sm-9 col-form-label">カテゴリー1</label>
                        <input type="text" class="col-sm-9 form-control" readonly id="Category1" v-model="question.Category1">
                    </div>
                    <div class="form-group column">
                        <label for="Category2" class="col-sm-9 col-form-label">カテゴリー2</label>
                        <input type="text" class="col-sm-9 form-control" readonly id="Category2" v-model="question.Category2">
                    </div>
                    <div class="form-group column">
                        <label for="Category3" class="col-sm-9 col-form-label">カテゴリー3</label>
                        <input type="text" class="col-sm-9 form-control" readonly id="Category3" v-model="question.Category3">
                    </div>

                </form>
            </div>
        </div>
    </div>
</template>

<script>
    import api from "../../api/index";

    export default {
        props: {
            questionId: Number
        },
        data: function () {
            return {
                question: {}
            }
        },
        methods: {
            getQuestion() {
                api({
                    method : 'GET',
                    url    : '/api/questions/' + this.questionId
                })
                    .then((res) => {
                        this.question = res;
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
