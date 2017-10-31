<template>
    <div>
        <h2 id='ct' style="background-color: #FFFF00; opacity: 1; text-align: center" >{{ time}}</h2>
        <embed src="http://thitracnghiem.cf/storage/15090159220114.mp3" style="opacity: 0; display: none;" id="sound">
        <div class="exams">
            <div class="test-header">
                <h1>Bài kiểm tra môn {{ subject }}</h1>
                <span>Thời gian: {{ hours }} phút</span>
                <div class="note"> (Phải chọn hết đáp án cho tất cả các câu hỏi trước khi hết giờ.)</div>
            </div>
            <div class="test-content">
                <form method="post" action="/get-mark">
                    <input type="hidden" name="_token" :value="token">
                    <div class="button-change">
                        <div class="mdl-button mdl-js-button mdl-button--raised" @click="isShowAns=true" v-show="!isShowAns">Chọn đáp án</div>
                        <div class="mdl-button mdl-js-button mdl-button--raised" @click="isShowAns=false" v-show="isShowAns">Ẩn chọn</div>
                    </div>
                    <div class="button-show">
                        <div class="mdl-button mdl-js-button mdl-button--raised" @click="isShow=true" v-show="!isShow">Câu chưa làm</div>
                        <div class="mdl-button mdl-js-button mdl-button--raised" @click="isShow=false" v-show="isShow">Ẩn</div>
                    </div>
                    <div class="anwser" v-show="isShowAns">
                        <ul class="list-group" for="ans-left">
                            <li class="list-group-item" v-for="anwser in anwsers" :id="'ans'+anwser">{{ anwser }}.
                                <div class="anwser__item">
                                    <label class="mdl-radio">
                                        <input type="radio" :name="'ans['+anwser+']'" value="a" class="mdl-radio__button">
                                        <span class = "mdl-radio__label">A</span>
                                    </label>
                                </div>
                                <div class="anwser__item">
                                    <label class="mdl-radio">
                                        <input type="radio" :name="'ans['+anwser+']'" value="b" class="mdl-radio__button">
                                        <span class = "mdl-radio__label">B</span>
                                    </label>
                                </div>
                                <div class="anwser__item">
                                    <label class="mdl-radio">
                                        <input type="radio" :name="'ans['+anwser+']'" value="c" class="mdl-radio__button">
                                        <span class = "mdl-radio__label">C</span>
                                    </label>
                                </div>
                                <div class="anwser__item">
                                    <label class="mdl-radio">
                                        <input type="radio" :name="'ans['+anwser+']'" value="d" class="mdl-radio__button">
                                        <span class = "mdl-radio__label">D</span>
                                    </label>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div class="photo" v-show="timeNow >= timeStart">
                        <div class="photo-item" v-for="img in photo">
                            <img :src="img.photo">
                        </div>
                    </div>
                    <input type="hidden" name="_action" value="get-mark">
                    <input type="hidden" name="exam_id" :value="exam_id">
                    <input type="hidden" name="class" :value="classes">
                    <input type="hidden" name="subject" :value="subjectId">
                    <input type="hidden" name="is_on_time" :value="ontime">
                    <div class="submit">
                        <div class="mdl-button mdl-js-button mdl-button--raised" @click="checkSubmit()">Nộp bài</div>
                    </div>
                </form>
            </div>
        </div>
        <div class="sentence" v-show="start <= 180 || isShow">
            <ul class="list-group display-flex">
                <li class="list-group-item" v-for="s in sentences" v-if="s"><a :href="'#ans'+s">{{ s }}</a></li>
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
                isShowAns: false,
                exams: [],
                photo: [],
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
                anwsers: [],
                now: '',
                ontime: '',
                timeStart: ''
            }
        },
        computed: {
            formatValue() {
                return this.value
            },
            timeNow() {
                return this.now;
            }
        },
        methods: {
            init() {
                let url = `/test/${this.value}`;
                this.token = $('#token').attr('content');
                this.$http.get(url).then((response) => {
                    this.exams = response.data.exam;
                    this.photo = response.data.photo;
                    this.ontime = response.data.onTime;
                    this.hours = parseInt(this.exams.time_exam);
                    if(this.exams) {
                        let i = 1;
                        let j = 1;
                        this.sentences = Array.from(Array(this.exams.num_sentence), ()=> i++);
                        this.anwsers = Array.from(Array(this.exams.num_sentence), ()=> j++);
                        this.subject = this.exams.name;
                        this.exam_id = this.exams.exam_id;
                        this.subjectId = this.exams.id;
                        this.classes = this.exams.class;
                        this.start = this.start * parseInt(response.data.timeExam);
                        this.timeStart = this.exams.start_time;
                        this.now = this.currentdate();
                        if(this.now >= this.timeStart) {
                            this.showTime()
                        }
                    }
                })
            },
            currentdate() {
                let currentdate = new Date();
                return currentdate.getFullYear() + "-"
                + (currentdate.getMonth()+1)  + "-"
                + currentdate.getDate() + ' '
                + currentdate.getHours() + ":"
                + currentdate.getMinutes() + ":"
                + currentdate.getSeconds()
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
    .photo-item {
        margin-top: 5px;
        width: 100%;
    }
    .photo-item img{
        width: 100%;
        height: auto;
    }
    .button-change {
        position: fixed;
        top: 19%;
        left: 1%;
    }
    .button-show {
        position: fixed;
        top: 19%;
        right: 1%;
    }
    .photo {
        margin-left: 6%;
        max-width: 100%;
    }
    .anwser {
        position: fixed;
        top: 20%;
        left: 1%;
        width: 14%;
        display: flex;
        flex-wrap: wrap;
        justify-content: space-between;
        float: left;
        margin-top: 3%;
        height: 300px;
        overflow-y: auto;
    }
    .anwser::-webkit-scrollbar,
    .sentence::-webkit-scrollbar {
        width: 2px;
    }

    .anwser::-webkit-scrollbar-track.
    .sentence::-webkit-scrollbar-track {
        -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3);
        border-radius: 10px;
    }

    .anwser::-webkit-scrollbar-thumb,
    .sentence::-webkit-scrollbar-thumb {
        border-radius: 10px;
        -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.5);
    }
    .anwser ul {
        width: 100%;
    }
    .anwser ul li {
        width: 100%;
        display: flex;
        padding: 5px;
    }
    .anwser__item {
        width: 22%;
        margin-left: 8px;
    }
    .submit {
        margin: 40px auto;
        text-align: center;
    }
    .sentence {
        position: fixed;
        width: 10%;
        top: 22%;
        right: 1%;
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
            width: 20% !important;
        }
        .button-change {
            top: 90%;
        }
        .button-show {
            top: 90%;
        }
        .anwser{
            top: 42%;
            width: 50%;
            z-index: 999;
        }
        .sentence {
            top: 61%;
            right: 5%;
            width: 50%;
            background: #fff;
            padding-top: 0;
            z-index: 999;
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            float: left;
            height: 180px;
            overflow-y: auto;
            border: 1px solid #bfbfbf;
        }
        .text-header {
            font-size: 13px !important;
        }
    }
    .display-flex li {
        box-sizing: border-box;
        width: 24%;
        padding: 5px;
        text-align: center;
    }
    .display-flex li a {
        color: red;
    }
    .text-header {
        font-size: 20px;
        line-height: 1rem;
        color: red;
        font-weight: 600;
    }
</style>
