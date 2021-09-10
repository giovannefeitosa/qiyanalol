export interface IChampionList {
  champions: IChampionItem[];
}

export interface IChampionItem {
  name: string;
  slug: string;
  thumbnail: string;
  image: string;
}
