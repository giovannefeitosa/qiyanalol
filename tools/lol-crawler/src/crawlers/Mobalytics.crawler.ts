import Axios from 'axios';
import { JSDOM } from 'jsdom';
import { IChampionItem, IChampionList } from "../interfaces/Champions.interface";
import { ICrawler } from "../interfaces/Crawler.interface";

export class MobalyticsCrawler implements ICrawler {
  async getChampionsJson(): Promise<IChampionList> {
    const output: IChampionList = {
      champions: [],
    };

    // Visit each champion url and get its data
    console.log('going to fetch champion list of urls...');
    const urlsChampions = await this._fetchChampionsUrls();
    console.log('list of urls ok!');
    console.log('');

    console.log('going to fetch each champion individually...');
    for (let idx in urlsChampions) {
      const url = urlsChampions[idx];
      process.stdout.write(`- (${Number(idx)+1}/${urlsChampions.length}) ${url} ... `);
      const championItem = await this._fetchChampion(url);
      process.stdout.write('finished ' + championItem.slug + '\n');
      output.champions.push(championItem);
    }

    // Test if champions list are ok
    this._validateChampionList(output);

    return output;
  }

  // Return a list of urls
  private async _fetchChampionsUrls(): Promise<string[]> {
    const resChampions = await Axios.get('https://app.mobalytics.gg/lol/champions');
    const htmlChampions = resChampions.data;
    const domChampions = new JSDOM(htmlChampions);

    const script1: IScriptChampionList = JSON.parse(domChampions.window.document.querySelectorAll('script[type="application/ld+json"]')[0].innerHTML);
    const championsUrls: string[] = script1.itemListElement.reduce((prev, curr) => {
      return [...prev, curr.url];
    }, [] as string[]);

    // Test if this list is ok
    if (championsUrls[0].indexOf('aatrox') === -1 || championsUrls[1].indexOf('ahri') === -1) {
      throw new Error('INVALID CHAMPIONS. PLEASE CHECK crawlers/Mobalytics.crawler.ts @ _fetchChampionsUrls() method');
    }

    return championsUrls;
  }

  // Return a Champion object (from url)
  // Example: view-source:https://app.mobalytics.gg/lol/champions/aatrox/build
  private async _fetchChampion(championUrl: string, _tryCount: number = 0): Promise<IChampionItem> {
    try {
      const resChampionItem = await Axios.get(championUrl, {
        timeout: 12000,
      });
      const htmlChampionItem = resChampionItem.data;
      const domChampionItem = new JSDOM(htmlChampionItem);

      const script1: IScriptChampionItem = JSON.parse(domChampionItem.window.document.querySelectorAll('script[type="application/ld+json"]')[0].innerHTML);
      const slug = script1.url.split('/')[5];
      const champion: IChampionItem = {
        slug,
        name: script1.name,
        image: script1.image,
        thumbnail: `https://fastcdn.mobalytics.gg/assets/lol/images/dd/champions/icons/${slug}.png`,
      };

      return champion;
    } catch(error) {
      if (_tryCount < 10) {
        console.log('Error! retrying...');
        // If error happens, then retry
        return this._fetchChampion(championUrl, _tryCount + 1);
      } else {
        throw error;
      }
    }
  }

  // Validate if Champions List are ok
  private async _validateChampionList(championsList: IChampionList) {
    if (championsList.champions[0].slug !== 'aatrox' || championsList.champions[1].slug !== 'ahri') {
      throw new Error('INVALID CHAMPIONS. PLEASE CHECK crawlers/Mobalytics.crawler.ts @ _validateChampionList() method');
    }
  }
}

type IScriptChampionList = {
  itemListElement: {
    url: string;
  }[];
}

// Example: view-source:https://app.mobalytics.gg/lol/champions/aatrox/build
type IScriptChampionItem = {
  name: string;
  additionalName: string;
  honorificSuffix: string;
  description: string;
  disambiguatingDescription: string;
  image: string; // big image
  url: string; // current url
  // @TODO ~ what about "knowsAbout" and "identifier"?
}
