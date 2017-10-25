<template>
    <div class="container">
        <h2 id='ct' style="background-color: #FFFF00; opacity: 1; text-align: center" >{{ time}}</h2>
        <embed src="http://test-tn.local/storage/1508902886071.mp3" style="opacity: 0; display: none;" id="sound">
        <div class="exams" v-if="exams.length">
            <div class="test-header">
                <h1>Bài kiểm tra môn {{ subject }}</h1>
                <span>Thời gian: {{ hours }} phút</span>
                <div class="note"> (Phải chọn hết đáp án cho tất cả các câu hỏi trước phi hết giờ.)</div>
            </div>
            <div class="test-content">
                <form method="post" action="/get-mark">
                    <input type="hidden" name="_token" :value="token">
                    <div class="content-item" v-for="exam in exams">
                        <div class="question">
                            <span>{{ exam['stt']}}. </span>
                            <span>{{ exam['content'] }}</span>
                        </div>
                        <div class="anwser">
                            <div class="anwser__item">
                                <label class="mdl-radio">
                                    <input type="radio" :name="'ans['+exam['stt']+']'" value="a" class="mdl-radio__button">
                                    <span class = "mdl-radio__label">A. {{ exam['ans_a'] }}</span>
                                </label>
                            </div>
                            <div class="anwser__item">
                                <label class="mdl-radio">
                                    <input type="radio" :name="'ans['+exam['stt']+']'" value="b" class="mdl-radio__button">
                                    <span class = "mdl-radio__label">B. {{ exam['ans_b'] }}</span>
                                </label>
                            </div>
                            <div class="anwser__item">
                                <label class="mdl-radio">
                                    <input type="radio" :name="'ans['+exam['stt']+']'" value="c" class="mdl-radio__button">
                                    <span class = "mdl-radio__label">C. {{ exam['ans_c'] }}</span>
                                </label>
                            </div>
                            <div class="anwser__item">
                                <label class="mdl-radio">
                                    <input type="radio" :name="'ans['+exam['stt']+']'" value="d" class="mdl-radio__button">
                                    <span class = "mdl-radio__label">D. </span>{{ exam['ans_d'] }}
                                </label>
                            </div>
                        </div>
                        <div v-if="hasPicture(exam['picture'])" class="picture">
                            <img :src="exam['picture']">
                        </div>
                    </div>
                    <input type="hidden" name="_action" value="get-mark">
                    <input type="hidden" name="exam_id" :value="exam_id">
                    <input type="hidden" name="class" :value="classes">
                    <input type="hidden" name="subject" :value="subjectId">
                    <div class="submit">
                        <div class="mdl-button mdl-js-button mdl-button--raised" @click="checkSubmit()">Nộp bài</div>
                    </div>
                </form>
            </div>
        </div>
        <div v-else class="no-exam">Khong co bai</div>
        <div class="sentence" v-if="start <= 180 || isShow">
            <p class="text-header">Câu chưa làm: </p>
            <ul class="list-group display-flex">
                <li class="list-group-item" v-for="s in sentences" v-if="s">{{ s }}</li>
            </ul>
        </div>
    </div>
</template>

<script>
    export default {
        props:{
            value: {
                value: String,
            },
        },
        data() {
            return {
                exams: [],
                subject: '',
                hours: '',
                step : 0.1,
                delay : 1000,
                start : 60,
                time : '00:00:00',
                token: '',
                exam_id: '',
                classes: '',
                subjectId: '',
                sentences: [],
                formData : [],
                isZero: 1,
                isShow: false,
            }
        },
        computed: {
            formatValue() {
                return this.value
            }
        },
        methods: {
            init() {
                let url = `/test/${this.value}`;
                this.token = $('#token').attr('content');
                this.$http.get(url).then((response) => {
                    this.exams = response.data;
                    if(this.exams.length) {
                        let i = 1;
                        this.sentences = Array.from(Array(this.exams.length), ()=> i++);
                        this.subject = this.exams[0].name;
                        this.exam_id = this.exams[0].exam_id;
                        this.subjectId = this.exams[0].id;
                        this.classes = this.exams[0].class;
                        this.hours = parseInt(this.exams[0].time_test);
                        this.start = this.start * this.hours;
                        this.showTime()
                    }
                })
            },
            hasPicture(picture) {
                return picture ? true : false;
            },
            showTime() {
                this.displayTimes();
                this.hideTime();
            },
            alarm() {
                let sound = document.getElementById('sound');
                sound.style.display = 'block';
            },
            displayTimes() {
                let el = document.getElementById('ct');
                let end = 0
                let refresh = 1000;
                if(window.localStorage.getItem('start') != null) {
                    this.start = window.localStorage.getItem('start');
                    window.localStorage.removeItem('start');
                }
                if( this.start >= end ) {
                    if(this.start == 60) {
                        this.displayTime(0)
                        el.style.opacity = 1;
                    }
                    setTimeout(function () { this.displayCountTime() }.bind(this), refresh )
                }
            },
            hideTime() {
                let el = document.getElementById('ct');
                if (el.style.opacity >= 0) {
                    el.style.opacity -= this.step;
                    setTimeout(function () { this.hideTime() }.bind(this), this.delay);
                }
            },
            displayTime(delay) {
                let el = document.getElementById('ct');
                if (el.style.opacity < 1) {
                    el.style.opacity += this.step;
                    setTimeout(function () { this.displayTime() }.bind(this), delay);
                }
            },
            displayCountTime () {
                let hours = Math.floor(this.start/3600);
                let start = this.start%3600;
                this.time =  hours + ":" + Math.floor(start/60) + ":" + Math.floor(start%60);
                this.start = this.start - 1;
                let tt = this.displayTimes();
            },
            checkSubmit() {
                this.checkSentence();
                if(!_.sum(this.sentences)) {
                    $('form').submit();
                } else {
                    this.isShow = true;
                }
            },
            checkSentence() {
                let form = $('form').serializeArray();
                let self = this;
                _.forEach(form, function(value, key) {
                    if(_.includes(value.name, 'ans')) {
                        let num = value.name.replace('ans[', '').replace(']', '');
                        self.formData.push(parseInt(num));
                    }
                })
                _.forEach(self.formData, function(value, key) {
                    self.sentences[value -1] = 0;
                })
            },
            leaving() {
                window.localStorage.setItem('start', this.start);
            }
        },
        watch: {
            value(val) {
            },
            start(val) {
                if(!this.start) {
                    this.alarm();
                    this.checkSubmit();
                }
                this.checkSentence();
            },
        },
        mounted() {
            this.init();
            window.onbeforeunload = this.leaving;
        },
    }
</script>
<style scoped>
    .note {
        display: block;
        width: 100%;
        text-align: center;
        font-size: 1.5rem;
        color: #000;
    }
    h1 {
        width: 100%;
        text-align: center;
        color: #000;
        font-weight: 600;
        font-size: 2.6em;
    }
    .test-header span {
        margin: 10px auto;
        display: block;
        color: #999;
        font-size: 1.5em;
        font-weight: 500;
        text-align: center;
    }
    .test-content{
        width: 100%;
        display: block;
        margin-top: 10%;
    }
    .content-item {
        display: block;
        width: 100%;
        clear: both;
        min-height: 170px;
    }
    .question {
        width: 100%;
    }
    .question span {
        font-size: 18px;
        color: #000;
        font-weight: 600;
    }
    .anwser {
        width: 70%;
        display: flex;
        flex-wrap: wrap;
        justify-content: space-between;
        float: left;
        margin-top: 3%;
    }
    .anwser__item {
        width: 46%;
        min-height: 50px;
    }
    .picture {
        width: 22%;
        margin-left: 5%;
        float: left;
        min-height: 100px;
    }
    .picture img {
        width: 100%;
        height: auto;
    }
    .submit {
        margin: 40px auto;
        text-align: center;
    }
    .sentence {
        position: fixed;
        width: 200px;
        top: 10%;
        right: 2%;
    }
    .display-flex {
        display: flex;
        width: 100%;
        justify-content: space-between;
        flex-wrap: wrap;
    }
    @media screen and (max-width: 768px) {
        .display-flex {
            width: 100%;
            background: #fff;
        }
        .display-flex li {
            padding: 5px;
            width: 9% !important;
        }
        .sentence {
            top: 8%;
            right: 0;
            width: 100%;
            left: 0;
            background: #fff;
            padding-top: 8px;
        }
        .text-header {
            font-size: 13px !important;
        }
    }
    .display-flex li {
        box-sizing: border-box;
        width: 24%;
        margin: 0;
    }
    .text-header {
        font-size: 20px;
        line-height: 1rem;
        color: red;
        font-weight: 600;
    }
</style>
