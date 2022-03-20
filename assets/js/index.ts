// Assets
import 'bootstrap';

const button = $("#myButton");
const output = $("#output");

function add(num1: number, num2: number): string {
    return String(num1 + num2);
}

button.on("click", () => {
    output.text(add(5, 6));
});