<script>
import axios from "axios";

export default {
  data() {
    return {
      passwordShown: false,
    };
  },
  methods: {
    togglePassword() {
      this.passwordShown = !this.passwordShown;
    },
    fetchData() {
      axios
        .get("http://127.0.0.1:8000/casepage/1", {
          mode: "no-cors",
          headers: {
            "Access-Control-Allow-Origin": "*",
            "Content-Type": "application/json",
          },
        })
        .then((res) => console.log(res));
    },
  },
};
</script>

<template>
  <div class="mainContainer">
    <div class="visuals ps-3 pt-3">
      <div class="logoText d-flex w-25 align-items-start">
        <img
          class="logo me-2 ms-4"
          src="../../assets/SVG/logo.svg"
          alt="wesal logo"
        />
        <h4 class="fw-bold">wesal</h4>
      </div>
      <div class="slogan ms-4">
        <h1 class="fw-bold">Help others</h1>
        <h4 class="fw-normal">help you...</h4>
      </div>
      <img class="hand" src="../../assets/SVG/Hand.svg" alt />
    </div>
    <main>
      <h1 class="text-center fw-bold mb-4">Login</h1>
      <form class="mb-4">
        <div class="form-floating">
          <input
            class="rounded-pill form-control"
            id="floatingInput"
            type="email"
            placeholder="email"
            v-model="email"
          />
          <label for="floatingInput">email</label>
        </div>
        <div class="form-floating passwordContainer">
          <input
            class="rounded-pill form-control"
            :type="passwordShown ? 'text' : 'password'"
            placeholder="Password"
            v-model="password"
          />
          <label for="floatingInput">password</label>
          <i
            @click="togglePassword"
            :class="[
              'bi',
              passwordShown ? 'bi-eye-slash' : 'bi-eye',
              'eyeIcon',
            ]"
          ></i>
        </div>
        <button
          @click.prevent="fetchData"
          class="border-0 rounded-pill fw-normal"
        >
          sign in
        </button>
        <h6 class="text-center">or login using</h6>
        <div class="thirdParty">
          <span class="border rounded-circle border-0 text-light">
            <i class="bi bi-google"></i>
          </span>
          <span class="border rounded-circle border-0 text-light">
            <i class="bi bi-facebook"></i>
          </span>
        </div>
      </form>
      <div class="signup text-center">
        Don`t have an account?
        <router-link to="./" class="fw-bold text-decoration-none"
          >sign up</router-link
        >
      </div>
    </main>
  </div>
</template>

<style lang="scss" scoped>
*,
*::before,
*::after {
  box-sizing: border-box;
  font-family: "Poppins", sans-serif;
}
$secColor: #91ffa2;
$priColor: #0f9172;

.mainContainer {
  height: 100vh;
  display: grid;
  column-gap: 20px;
  grid-template-columns: repeat(12, 1fr);
  .visuals {
    height: 100%;
    width: 100%;
    padding-inline: 70px;
    background: linear-gradient($secColor, $priColor);
    grid-column: 1/8;
    display: grid;
    grid-template-rows: repeat(3, auto);
    .logoText {
      .logo {
        width: 2rem;
      }

      h4 {
        color: #0a5c49;
      }
    }
    .slogan {
      color: #0a5c49;
      h1 {
        font-size: 64px;
      }
      h4 {
        font-size: 30px;
      }
    }
    .hand {
      width: 500px;
      width: fit-content;
      height: 60vh;
      align-self: end;
      justify-self: center;
      // background: red;
    }
  }
  main {
    grid-column: 9/12;
    align-self: center;
    justify-self: center;
    // border: 1px solid red;
    h1 {
      color: $priColor;
      font-size: 64px;
    }
    form {
      display: grid;
      row-gap: 1.3em;
      .passwordContainer {
        // display: flex;
        position: relative;
        .eyeIcon {
          position: absolute;
          color: #57ce8d;
          font-size: 25px;
          top: 9px;
          right: 20px;
          cursor: pointer;
        }
      }
      input {
        border: 2px solid #57ce8d;
        color: $priColor;
        outline: none;
        padding-inline: 2em;
        width: 350px;
        height: 50px;
        font-weight: bold;
      }
      label {
        color: $priColor;
        margin-inline: 20px;
        margin-top: -5px;
        font-weight: 500;
      }
      .thirdParty {
        display: flex;
        justify-self: center;
        gap: 1em;
        span {
          width: 40px;
          height: 40px;
          display: grid;
          background: $priColor;
          cursor: pointer;

          .bi-google {
            font-size: 22px;
            justify-self: center;
            align-self: center;
          }

          .bi-facebook {
            font-size: 24px;
            justify-self: center;
            align-self: center;
          }
        }
      }
      button {
        background: $priColor;
        color: white;
        justify-self: center;
        font-size: 18px;
        width: 100px;
        height: 30px;
      }
    }
    .signup {
      a {
        color: $priColor;
      }
    }
  }
}
</style>
