var dataSet = [10805065, 10682822, 7234343, 5531861, 5142723, 4758957, 4208994, 4021758, 3847041, 3229457];

// 막대 차트에 사용할 SVG 요소 선택
const svg1 = d3.select("#myGraph1");
const svg2 = d3.select("#myGraph2");
const svg3 = d3.select("#myGraph3");
const svg4 = d3.select("#myGraph4");
const svg5 = d3.select("#myGraph5");
const svg6 = d3.select("#myGraph6");
const svg7 = d3.select("#myGraph7");
const svg8 = d3.select("#myGraph8");
const svg9 = d3.select("#myGraph9");
const svg10 = d3.select("#myGraph10");

// 막대 차트의 너비 및 높이 정의
const width = 500;
const height = 20;

// 직사각형 추가
svg1.append("rect")
  .attr("x", 0)
  .attr("y", 0)
  .attr("width", dataSet[0] / 50000)
  .attr("height", height)
  .attr("fill", "blueviolet");

svg2.append("rect")
  .attr("x", 0)
  .attr("y", 0)
  .attr("width", dataSet[1] / 50000)
  .attr("height", height)
  .attr("fill", "blueviolet");

svg3.append("rect")
  .attr("x", 0)
  .attr("y", 0)
  .attr("width", dataSet[2] / 50000)
  .attr("height", height)
  .attr("fill", "blueviolet");

svg4.append("rect")
  .attr("x", 0)
  .attr("y", 0)
  .attr("width", dataSet[3] / 50000)
  .attr("height", height)
  .attr("fill", "blueviolet");

svg5.append("rect")
  .attr("x", 0)
  .attr("y", 0)
  .attr("width", dataSet[4] / 50000)
  .attr("height", height)
  .attr("fill", "blueviolet");

svg6.append("rect")
  .attr("x", 0)
  .attr("y", 0)
  .attr("width", dataSet[5] / 50000)
  .attr("height", height)
  .attr("fill", "blueviolet");

svg7.append("rect")
  .attr("x", 0)
  .attr("y", 0)
  .attr("width", dataSet[6] / 50000)
  .attr("height", height)
  .attr("fill", "blueviolet");

svg8.append("rect")
  .attr("x", 0)
  .attr("y", 0)
  .attr("width", dataSet[7] / 50000)
  .attr("height", height)
  .attr("fill", "blueviolet");

svg9.append("rect")
  .attr("x", 0)
  .attr("y", 0)
  .attr("width", dataSet[8] / 50000)
  .attr("height", height)
  .attr("fill", "blueviolet");

  svg10.append("rect")
  .attr("x", 0)
  .attr("y", 0)
  .attr("width", dataSet[9] / 50000)
  .attr("height", height)
  .attr("fill", "blueviolet");

// 각 막대 옆에 숫자 추가
svg1.append("text")
  .text(Number(dataSet[0]).toLocaleString()+"명")
  .attr("x", dataSet[0] / 50000 + 5)
  .attr("y", height / 2)
  .attr("text-anchor", "start")
  .attr("dominant-baseline", "middle")
  .attr("font-size", "12px")
  .attr("fill", "white");

svg2.append("text")
  .text(Number(dataSet[1]).toLocaleString()+"명")
  .attr("x", dataSet[1] / 50000 + 5)
  .attr("y", height / 2)
  .attr("text-anchor", "start")
  .attr("dominant-baseline", "middle")
  .attr("font-size", "12px")
  .attr("fill", "white");

svg3.append("text")
  .text(Number(dataSet[2]).toLocaleString()+"명")
  .attr("x", dataSet[2] / 50000 + 5)
  .attr("y", height / 2)
  .attr("text-anchor", "start")
  .attr("dominant-baseline", "middle")
  .attr("font-size", "12px")
  .attr("fill", "white");

svg4.append("text")
  .text(Number(dataSet[3]).toLocaleString()+"명")
  .attr("x", dataSet[3] / 50000 + 5)
  .attr("y", height / 2)
  .attr("text-anchor", "start")
  .attr("dominant-baseline", "middle")
  .attr("font-size", "12px")
  .attr("fill", "white");

svg5.append("text")
  .text(Number(dataSet[4]).toLocaleString()+"명")
  .attr("x", dataSet[4] / 50000 + 5)
  .attr("y", height / 2)
  .attr("text-anchor", "start")
  .attr("dominant-baseline", "middle")
  .attr("font-size", "12px")
  .attr("fill", "white");

svg6.append("text")
  .text(Number(dataSet[5]).toLocaleString()+"명")
  .attr("x", dataSet[5] / 50000 + 5)
  .attr("y", height / 2)
  .attr("text-anchor", "start")
  .attr("dominant-baseline", "middle")
  .attr("font-size", "12px")
  .attr("fill", "white");

svg7.append("text")
  .text(Number(dataSet[6]).toLocaleString()+"명")
  .attr("x", dataSet[6] / 50000 + 5)
  .attr("y", height / 2)
  .attr("text-anchor", "start")
  .attr("dominant-baseline", "middle")
  .attr("font-size", "12px")
  .attr("fill", "white");

svg8.append("text")
  .text(Number(dataSet[7]).toLocaleString()+"명")
  .attr("x", dataSet[7] / 50000 + 5)
  .attr("y", height / 2)
  .attr("text-anchor", "start")
  .attr("dominant-baseline", "middle")
  .attr("font-size", "12px")
  .attr("fill", "white");

svg9.append("text")
  .text(Number(dataSet[8]).toLocaleString()+"명")
  .attr("x", dataSet[8] / 50000 + 5)
  .attr("y", height / 2)
  .attr("text-anchor", "start")
  .attr("dominant-baseline", "middle")
  .attr("font-size", "12px")
  .attr("fill", "white");
  
svg10.append("text")
.text(Number(dataSet[9]).toLocaleString()+"명")
.attr("x", dataSet[9] / 50000 + 5)
.attr("y", height / 2)
.attr("text-anchor", "start")
.attr("dominant-baseline", "middle")
.attr("font-size", "12px")
.attr("fill", "white");