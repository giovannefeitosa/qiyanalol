import { IChampionList } from "./Champions.interface";

export interface ICrawler {
  getChampionsJson: () => Promise<IChampionList>;
}
