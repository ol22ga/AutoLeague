// const rangeInput = document.querySelectorAll(".filter-price__range"),
//     priceInput = document.querySelectorAll(".filter-price__input"),
//     range = document.querySelector(".filter-price__progress");
// let priceGap = 10;
//
// priceInput.forEach(input =>{
//     input.addEventListener("input", e =>{
//         let minPrice = parseInt(priceInput[0].value),
//             maxPrice = parseInt(priceInput[1].value);
//
//         if((maxPrice - minPrice >= priceGap) && maxPrice <= rangeInput[1].max){
//             if(e.target.className === "input-min"){
//                 rangeInput[0].value = minPrice;
//                 range.style.left = ((minPrice / rangeInput[0].max) * 100) + "%";
//             }else{
//                 rangeInput[1].value = maxPrice;
//                 range.style.right = 100 - (maxPrice / rangeInput[1].max) * 100 + "%";
//             }
//             if(e.target.className === "input-max"){
//                 rangeInput[1].value = maxPrice;
//                 range.style.right = 100 - (maxPrice / rangeInput[1].max) * 100 + "%";
//             }else{
//                 rangeInput[0].value = minPrice;
//                 range.style.left = ((minPrice / rangeInput[0].max) * 100) + "%";
//             }
//         }
//     });
// });
//
// rangeInput.forEach(input =>{
//     input.addEventListener("input", e =>{
//         let minVal = parseInt(rangeInput[0].value),
//             maxVal = parseInt(rangeInput[1].value);
//
//         if((maxVal - minVal) < priceGap){
//             if(e.target.className === "range-min"){
//                 rangeInput[0].value = maxVal - priceGap
//             }else{
//                 rangeInput[1].value = minVal + priceGap;
//             }
//             if(e.target.className === "range-max"){
//                 rangeInput[1].value = minVal + priceGap;
//             }else{
//                 rangeInput[0].value = maxVal - priceGap
//             }
//         }else{
//             priceInput[0].value = minVal;
//             priceInput[1].value = maxVal;
//             range.style.left = ((minVal / rangeInput[0].max) * 100) + "%";
//             range.style.right = 100 - (maxVal / rangeInput[1].max) * 100 + "%";
//         }
//     });
// });
