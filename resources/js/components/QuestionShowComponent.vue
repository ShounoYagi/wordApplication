<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-sm-6">
                <form>

                    <div class="form-group row">
                        <label for="QuestionText" class="col-sm-3 col-form-label">問題文</label>
                       <input type="text" class="col-sm-9 form-control-plaintext" readonly id="QuestionText" v-model="question.QuestionText">
                    </div>
                    <div class="form-group row">
                        <label for="Answer" class="col-sm-3 col-form-label">答え</label>
                        <input type="text" class="col-sm-9 form-control-plaintext" readonly id="Answer" v-model="question.Answer">
                    </div>
                    <div class="form-group row">
                        <label for="Category1" class="col-sm-3 col-form-label">カテゴリー1</label>
                        <input type="text" class="col-sm-9 form-control-plaintext" readonly id="Category1" v-model="question.Category1">
                    </div>
                    <div class="form-group row">
                        <label for="Category2" class="col-sm-3 col-form-label">カテゴリー2</label>
                        <input type="text" class="col-sm-9 form-control-plaintext" readonly id="Category2" v-model="question.Category2">
                    </div>
                    <div class="form-group row">
                        <label for="Category3" class="col-sm-3 col-form-label">カテゴリー3</label>
                        <input type="text" class="col-sm-9 form-control-plaintext" readonly id="Category3" v-model="question.Category3">
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
