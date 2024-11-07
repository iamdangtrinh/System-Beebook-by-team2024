const puppeteer = require('puppeteer');

(async () => {
    const url = process.argv[2];

    const browser = await puppeteer.launch();
    const page = await browser.newPage();

    try {
        await page.goto(url, { waitUntil: 'networkidle2' });

        // Chờ phần tử #desc_content xuất hiện và có nội dung HTML
        await page.waitForSelector('#desc_content', { visible: true, timeout: 10000 });
        await page.waitForFunction(
            () => document.querySelector('#desc_content').innerHTML.trim().length > 0,
            { timeout: 10000 }
        );

        // Lấy nội dung HTML từ phần tử #desc_content
        const descriptionHTML = await page.evaluate(() => {
            return document.querySelector('#desc_content').innerHTML.trim();
        });

        console.log(descriptionHTML || 'No description available');
    } catch (error) {
        console.error(`Error fetching description: ${error.message}`);
    } finally {
        await browser.close();
    }
})();
