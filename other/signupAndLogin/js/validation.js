// Create a new validation object passing the selector of the signup form (id)
const validation = new JustValidate("#signup");

// add valditaion rules for each field
// with the field selector as first argument and an array of rules as the second
// each rule is an Object where we can specify one of the libraries library's build-in rules
// using the rule property
validation
  .addField(document.querySelector("#name"), [
    {
      rule: "required",
    },
  ])
  .addField(document.querySelector("#email"), [
    {
      rule: "required",
    },
    {
      rule: "email",
    },
  ])
  .addField(document.querySelector("password"), [
    {
      rule: "required",
    },
    {
      rule: "password",
    },
  ]);
