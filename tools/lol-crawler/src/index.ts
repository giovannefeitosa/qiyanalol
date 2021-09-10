import Axios from 'axios';
import { MobalyticsCrawler } from './crawlers/Mobalytics.crawler';
import { writeFileSync } from 'fs';
import { join } from 'path';

const CHAMPIONS_JSON_PATH = join(__dirname, '../../../wordpress/themes/generatepress-child/assets/json/champions.json');

async function main () {
  const crawler = new MobalyticsCrawler();
  const champions = await crawler.getChampionsJson();
  writeFileSync(CHAMPIONS_JSON_PATH, JSON.stringify(champions, null, 2));
}

main();
