const inStock = ['pizza', 'cookies', 'eggs', 'apples', 'milk', 'cheese', 'bread', 'lettuce', 'carrots', 'broccoli', 'potatoes', 'crackers', 'onions', 'tofu', 'limes', 'cucumbers'];

const searchRaw = prompt('Search for a product.');
let search = searchRaw.toLowerCase();

let message;

if (!search)
{
    message = `<strong>In stock:</strong> ${inStock.join(", ")}`
}
else if (inStock.includes(search))
{
    message = `Yes, we have <strong>${searchRaw}</strong>. It's #${inStock.indexOf(search)+1} on the list!`;
}
else
{
    message = `No, we don't have <strong>${searchRaw}</strong>.`;
}

document.querySelector("body").innerHTML = `<p>${message}</p>`;