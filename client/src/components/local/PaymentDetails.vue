<script>
export default {
    data() {
        return {

        }
    }
}

</script>

<template>
    <div class="payment mt-2">
        <!-- <h1>
            Payment details
            <i class="bi bi-pencil-square h2 ms-5"></i>
        </h1> -->
        <div class="paymentInfo d-flex flex-column">
            <label for="nameOnCard">Name on card</label>
            <input name="nameOnCard" placeholder="JHON DOE" class="rounded-pill" type="text" />
            <label for="cardNumber">Card number</label>
            <div class="creditCard">
                <input
                    name="cardNumber"
                    placeholder="xxxx xxxx xxxx xxxx"
                    class="rounded-pill"
                    type="text"
                />
                <img src="../../assets/SVG/mastercard.svg" alt="card type" />
            </div>
            <div class="expCvv gap-0">
                <div class="d-inline">
                    <label class="me-2" for="expdate">exp</label>
                    <input name="expdate" class="rounded-pill me-4" type="text" />
                </div>
                <div class="d-inline">
                    <label class="me-2" for="cvv">cvv</label>
                    <input name="cvv" class="rounded-pill" type="text" />
                </div>
            </div>
            <div class="otherPayemnts">
                <p class="mb-2 mt-2">another payment service?</p>
                <div class="services px-2 d-flex gap-2">
                    <a href="https://www.paypal.com/" target="blank">
                        <img src="../../assets/SVG/paypal.svg" alt="paypal" />
                    </a>
                    <a href="https://www.paypal.com/" target="blank">
                        <img src="../../assets/SVG/meeza logo.svg" alt="meeza" />
                    </a>
                    <a href="https://www.paypal.com/" target="blank">
                        <img src="../../assets/SVG/fawry pay logo.svg" alt="fawry" />
                    </a>
                </div>
            </div>
            <!-- <button class="btn btn-block save rounded-pill mt-5">save</button> -->
        </div>
    </div>
</template>

<style lang="scss" scoped>
@use '../../sass/colors' as *;
.payment {
    color: $priColor;
    i {
        visibility: hidden;
        cursor: pointer;
    }
    h1:hover i {
        visibility: visible;
    }
    .paymentInfo {
        label {
            font-style: normal;
            font-weight: 500;
            font-size: 18px;
            line-height: 27px;
            letter-spacing: -0.02em;
        }
        input {
            margin-top: 16px;
            border: none;
            padding-left: 1.5em;
            box-shadow: 0px 1px 3px rgba(0, 0, 0, 0.3);
            border: 1px solid transparent;
            outline: none;
            font-weight: 500;
            color: $priColor;
            margin-bottom: 20px;
            width: 50%;
        }
        .creditCard {
            position: relative;
            img {
                position: absolute;
                top: 14px;
                left: 190px;
            }
        }

        .expCvv {
            input {
                width: 15%;
                font-weight: 300;
                padding-left: 0.5em;
            }
        }
        //save button
        .save {
            background-color: $priColor;
            width: 10%;
            margin: auto;
            font-weight: normal;
            font-size: 18px;
            color: $white;
            letter-spacing: 0.05em;
        }
    }
}
</style>