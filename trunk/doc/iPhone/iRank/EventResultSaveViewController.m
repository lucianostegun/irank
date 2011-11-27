//
//  EventResultSaveViewController.m
//  iRank
//
//  Created by Luciano Stegun on 01/05/2011.
//  Copyright (c) 2011 __MyCompanyName__. All rights reserved.
//

#import "EventResultSaveViewController.h"
#import "EventPlayer.h"
#import "Constants.h"
#import "JSON.h"
#import "iRankAppDelegate.h"

@implementation EventResultSaveViewController
@synthesize event;
@synthesize eventPlayer;
@synthesize numberFormatter;
@synthesize resultPreviewViewController;

- (id)initWithNibName:(NSString *)nibNameOrNil bundle:(NSBundle *)nibBundleOrNil
{
    self = [super initWithNibName:nibNameOrNil bundle:nibBundleOrNil];
    if (self) {

        numberFormatter = [[NSNumberFormatter alloc] init];
        [numberFormatter setNumberStyle:NSNumberFormatterCurrencyStyle];
        [numberFormatter setDecimalSeparator:@","];
        [numberFormatter setCurrencyCode:@""];
        [numberFormatter setCurrencySymbol:@""];
    }
    return self;
}

-(void)viewWillAppear:(BOOL)animated {
    
    currentPosition = 0;
    
    [self loadPlayerInfo:currentPosition];
    
    [super viewWillAppear:animated];
    
    if( ![event.gameStyle isEqualToString:@"ring"] ){
        
        buyin.enabled           = NO;
        btnIncraseBuyin.enabled = NO;
        btnDecraseBuyin.enabled = NO;
    }else{
        
        buyin.enabled           = YES;
        btnIncraseBuyin.enabled = YES;
        btnDecraseBuyin.enabled = YES;
    }
    
    self.title = @"Resultados";
    self.navigationItem.rightBarButtonItem = doneButton;
    
    [[NSNotificationCenter defaultCenter] 
     addObserver:self selector:@selector
     (keyboardWillShow:) name:UIKeyboardWillShowNotification object:self.view.window];
}

-(void)viewWillDisappear:(BOOL)animated {
    
    [super viewWillDisappear:animated];
    [[NSNotificationCenter defaultCenter] removeObserver:self name: UIKeyboardWillShowNotification object:nil];
}

-(void)viewDidAppear:(BOOL)animated {
    
    [super viewDidAppear:animated];
}

-(void)loadPlayerInfo:(int)playerPositionIndex {
    
    eventPlayer         = [[event eventPlayerList] objectAtIndex:playerPositionIndex];
    playerName.text     = eventPlayer.player.fullName;
    playerPosition.text = [NSString stringWithFormat:@"%iª posição", (playerPositionIndex+1)];
    eventName.text      = event.eventName;
    eventPlaceDate.text = [NSString stringWithFormat:@"@%@ - %@ %@", event.eventPlace, event.eventDate, event.startTime];
    
    if( ![event.gameStyle isEqualToString:@"ring"] )
        eventPlayer.buyin = event.buyin;
    
    buyin.text = [NSString stringWithFormat:@"%@", [numberFormatter stringFromNumber:[NSNumber numberWithFloat:eventPlayer.buyin]]];
    rebuy.text = [NSString stringWithFormat:@"%@", [numberFormatter stringFromNumber:[NSNumber numberWithFloat:eventPlayer.rebuy]]];
    addon.text = [NSString stringWithFormat:@"%@", [numberFormatter stringFromNumber:[NSNumber numberWithFloat:eventPlayer.addon]]];
}

- (void)keyboardWillShow: (NSNotification *)notif {
    
    NSDictionary* info  = [notif userInfo];
    NSValue *aValue     = [info objectForKey:UIKeyboardBoundsUserInfoKey];
    CGSize keyboardSize = [aValue CGRectValue].size;
    
    float bottomPoint  = (buyin.frame.origin.y + buyin.frame.size.height + 10);
    scrollAmount = keyboardSize.height - (self.view.frame.size.height - bottomPoint);
    
    if(scrollAmount > 0) {
        moveViewUp = YES;
        [self scrollTheView:YES];
    }else
        moveViewUp = NO;
}

- (void)scrollTheView: (BOOL)movedUp {
    
    /*
     beginAnimations:: possui argumentos para passar informacão ao delegate da animação.
     Já que não vou usar nenhum delegate na aplicação, devo setar os argumentos para nil ou NULL.
     
     nil é usado quando há um ponteiro null para um objeto
     NULL é usado quando há um ponteiro null para qualquer outra coisa 
     */
    [UIView beginAnimations:nil context:NULL];
    [UIView setAnimationDuration:0.3];
    CGRect rect = self.view.frame;
    
    if(movedUp){
        rect.origin.y -= scrollAmount;
    }else{
        rect.origin.y += scrollAmount;
    }
    
    self.view.frame = rect;
    [UIView commitAnimations];
}

-(IBAction)loadNextPlayerInfo:(id)sender {
    
    currentPosition++;

    if ( currentPosition >= [[event eventPlayerList] count] )
        currentPosition = 0;
    
    [self loadPlayerInfo:currentPosition];
}

-(IBAction)loadPreviousPlayerInfo:(id)sender {

    currentPosition--;
    
    if ( currentPosition < 0 )
        currentPosition = [[event eventPlayerList] count]-1;
    
    [self loadPlayerInfo:currentPosition];
}

- (void)didReceiveMemoryWarning
{
    // Releases the view if it doesn't have a superview.
    [super didReceiveMemoryWarning];
    
    // Release any cached data, images, etc that aren't in use.
}

#pragma mark - View lifecycle

- (void)viewDidLoad
{
    [super viewDidLoad];
    
    doneButton = [[UIBarButtonItem alloc] initWithBarButtonSystemItem:UIBarButtonSystemItemDone target:self action:@selector(doneButtonTouchUp:)];
    saveButton = [[UIBarButtonItem alloc] initWithTitle:@"salvar" style:UIBarButtonItemStyleDone target:self action:@selector(saveButtonTouchUp:)];
    
    activityIndicator = [[UIActivityIndicatorView alloc] initWithActivityIndicatorStyle:UIActivityIndicatorViewStyleWhite];
    [activityIndicator setHidesWhenStopped:YES];
    [activityIndicator setHidden:YES];
    
    activityIndicatorButton =  [[UIBarButtonItem alloc] initWithCustomView:activityIndicator];
}

-(void)doneButtonTouchUp:(id)sender {

    [self.navigationController pushViewController:resultPreviewViewController animated:YES];
    
    saveButton.enabled        = NO;
    btnCalculatePrize.enabled = YES;
    resultPreviewViewController.navigationItem.rightBarButtonItem = saveButton;
}

-(void)saveButtonTouchUp:(id)sender {
    
    UIAlertView *alert = [[UIAlertView alloc] initWithTitle:@"Confirmação" message:@"Confirma salvar e enviar por e-mail o resultado do evento?" delegate:self cancelButtonTitle:@"Não" otherButtonTitles:@"Sim", nil];
    [alert show];
    [alert release];
}

-(void)concludeSaveResult {
    
    resultPreviewViewController.navigationItem.rightBarButtonItem = saveButton;
    
    event.savedResult = YES;
    btnCalculatePrize.enabled = YES;
    
    [resultPreviewViewController.navigationItem setHidesBackButton:NO animated:YES];
    
    iRankAppDelegate *appDelegate = (iRankAppDelegate *)[[UIApplication sharedApplication] delegate];
    
    [appDelegate showAlert:@"Resultado salvo" message:@"O resultado do evento foi salvo com sucesso!"];
    appDelegate.refreshHome = YES;
}

-(void)concludeCalculatePrize {
    
    [resultTableView reloadData];
    saveButton.enabled        = YES;
    btnCalculatePrize.enabled = YES;
    resultPreviewViewController.navigationItem.rightBarButtonItem = saveButton;
    [activityIndicator stopAnimating];
}

- (void)alertView:(UIAlertView *)alertView clickedButtonAtIndex:(NSInteger)buttonIndex{

	if (buttonIndex == 0) {
		
        NSLog(@"Clicou em NÃO");
	}else{
        
        [self doSaveEventResult];
	}
}

-(void)doSaveEventResult {
    
    resultPreviewViewController.navigationItem.rightBarButtonItem = nil;
    resultPreviewViewController.navigationItem.rightBarButtonItem = activityIndicatorButton;
    [activityIndicator setHidden:NO];
    [activityIndicator startAnimating];
    
    btnCalculatePrize.enabled = NO;
    [resultPreviewViewController.navigationItem setHidesBackButton:YES animated:YES];
    
    [event saveResult:self];
}

- (void)viewDidUnload
{
    [super viewDidUnload];
    // Release any retained subviews of the main view.
    // e.g. self.myOutlet = nil;
}

- (BOOL)shouldAutorotateToInterfaceOrientation:(UIInterfaceOrientation)interfaceOrientation
{
    // Return YES for supported orientations
    return YES;//(interfaceOrientation == UIInterfaceOrientationPortrait);
}

-(IBAction)incraseBuyinValue:(id)sender {
    
    eventPlayer.buyin += event.buyin;
    buyin.text = [NSString stringWithFormat:@"%@", [numberFormatter stringFromNumber:[NSNumber numberWithFloat:eventPlayer.buyin]]];
}

-(IBAction)decraseBuyinValue:(id)sender {
    
    eventPlayer.buyin -= event.buyin;

    if( eventPlayer.buyin < 0 )
        eventPlayer.buyin = 0;
    
    buyin.text = [NSString stringWithFormat:@"%@", [numberFormatter stringFromNumber:[NSNumber numberWithFloat:eventPlayer.buyin]]];
}

-(IBAction)incraseRebuyValue:(id)sender {
    
    eventPlayer.rebuy += event.buyin;
    rebuy.text = [NSString stringWithFormat:@"%@", [numberFormatter stringFromNumber:[NSNumber numberWithFloat:eventPlayer.rebuy]]];
}

-(IBAction)decraseRebuyValue:(id)sender {
    
    eventPlayer.rebuy -= event.buyin;
    
    if( eventPlayer.rebuy < 0 )
        eventPlayer.rebuy = 0;
    
    rebuy.text = [NSString stringWithFormat:@"%@", [numberFormatter stringFromNumber:[NSNumber numberWithFloat:eventPlayer.rebuy]]];
}

-(IBAction)incraseAddonValue:(id)sender {
    
    eventPlayer.addon += event.buyin;
    addon.text = [NSString stringWithFormat:@"%@", [numberFormatter stringFromNumber:[NSNumber numberWithFloat:eventPlayer.addon]]];
}

-(IBAction)decraseAddonValue:(id)sender {
    
    eventPlayer.addon -= event.buyin;
    
    if( eventPlayer.addon < 0 )
        eventPlayer.addon = 0;
    
    addon.text = [NSString stringWithFormat:@"%@", [numberFormatter stringFromNumber:[NSNumber numberWithFloat:eventPlayer.addon]]];
}

-(BOOL)textFieldShouldReturn:(UITextField *) theTextField {
    
    [theTextField resignFirstResponder];
    
    if(moveViewUp)
        [self scrollTheView:NO];
    
    switch ( theTextField.tag ) {
        case 1:
            eventPlayer.buyin = [theTextField.text floatValue];
            break;
        case 2:
            eventPlayer.rebuy = [theTextField.text floatValue];
            break;
        case 3:
            eventPlayer.addon = [theTextField.text floatValue];
            break;
            
        default:
            break;
    }
    
    return YES;
}


-(BOOL)textField:(UITextField *)textField shouldChangeCharactersInRange:(NSRange)range replacementString:(NSString *)string {

    NSString *nameRegex = @"[0-9,]"; 
    NSPredicate *nameTest = [NSPredicate predicateWithFormat:@"SELF MATCHES %@", nameRegex]; 
    BOOL isNumber = [nameTest evaluateWithObject:string];
    
    return (isNumber || [string isEqualToString:@""]);
}

#pragma mark - Tableview methods

- (NSInteger)numberOfSectionsInTableView:(UITableView *)tableView
{
    return 1;
}

- (NSInteger)tableView:(UITableView *)tableView numberOfRowsInSection:(NSInteger)section
{
    
    return [[event eventPlayerList] count];
}

- (UITableViewCell *)tableView:(UITableView *)tableView cellForRowAtIndexPath:(NSIndexPath *)indexPath
{
    
    static NSString *CellIdentifier = @"Cell";
    
    EventPlayer *aEventPlayer = [[event eventPlayerList] objectAtIndex:indexPath.row];
    Player *player = [aEventPlayer player];
    
    UITableViewCell *cell = [tableView dequeueReusableCellWithIdentifier:CellIdentifier];
    
    if (cell == nil)
        cell = [[[UITableViewCell alloc] initWithStyle:UITableViewCellStyleSubtitle reuseIdentifier:CellIdentifier] autorelease];
    
    cell.textLabel.text       = [NSString stringWithFormat:@"%iº %@", indexPath.row+1, [player fullName]];
    cell.detailTextLabel.text = [NSString stringWithFormat:@"B: %@, R: %@, A: %@ / Prêmio: %@", [numberFormatter stringFromNumber:[NSNumber numberWithFloat:aEventPlayer.buyin]], [numberFormatter stringFromNumber:[NSNumber numberWithFloat:aEventPlayer.rebuy]], [numberFormatter stringFromNumber:[NSNumber numberWithFloat:aEventPlayer.addon]], [numberFormatter stringFromNumber:[NSNumber numberWithFloat:aEventPlayer.prize]]];
    
    return cell;
}

- (NSString *)tableView:(UITableView *)tableView titleForHeaderInSection:(NSInteger)section {
    
        return [NSString stringWithFormat:@"%@ - %@ %@", event.eventName, event.eventDate, event.startTime];
}

- (NSString *)tableView:(UITableView *)tableView titleForFooterInSection:(NSInteger)section {
    
    return [NSString stringWithFormat:@"%i jogadores @%@", [event.eventPlayerList count], event.eventPlace];
}

-(void)calculatePrize:(id)sender {
        
    resultPreviewViewController.navigationItem.rightBarButtonItem = nil;
    resultPreviewViewController.navigationItem.rightBarButtonItem = activityIndicatorButton;
    [activityIndicator setHidden:NO];
    [activityIndicator startAnimating];
    
    btnCalculatePrize.enabled = NO;
    
    NSString *urlString = [NSString stringWithFormat:@"http://%@/ios.php/event/getPaidPlaces/eventId/%i/buyins/%f", serverAddress, event.eventId, [event totalBuyins]];
    
    NSURL *url = [NSURL URLWithString:urlString];
    
    NSURLRequest *request = [NSURLRequest requestWithURL:url];
    
    [NSURLConnection connectionWithRequest:request delegate:self];
    
    NSLog(@"urlString: %@", urlString);
}

- (void)connection: (NSURLConnection *)connection didReceiveResponse:(NSURLResponse *)response {
    
    NSLog(@"didReceiveResponse");
}

- (void)connection: (NSURLConnection *)connection didReceiveData:(NSData *)data {
    
    NSLog(@"didReceiveData");
    
    NSString *result = [[NSString alloc] initWithData:data encoding:NSASCIIStringEncoding];
    
    NSLog(@"result: %@", result);
    
    if( [result isEqualToString:@"savedResult"] ){
        
        [self concludeSaveResult];
    }else{
    
        SBJsonParser *jsonParser = [[SBJsonParser alloc] init];
        NSDictionary *jsonObjects = [jsonParser objectWithString:result error:nil];
        
        int paidPlaces = [[jsonObjects objectForKey:@"paidPlaces"] intValue];
        
        NSLog(@"paidPlaces: %i", paidPlaces);
        
        for(int i=1; i <= paidPlaces; i++){
            
            float playerPrize = [[jsonObjects objectForKey:[NSString stringWithFormat:@"%i", i]] floatValue];
            [[event.eventPlayerList objectAtIndex:(i-1)] setPrize:playerPrize];
        }
        
        [result release];
        [self concludeCalculatePrize];
    }
}

- (void)connectionDidFinishLoading:(NSURLConnection *)connection {
    
    NSLog(@"connectionDidFinishLoading");
}

-(void)dealloc {
    
    [event release];
    [eventPlayer release];
    [numberFormatter release];
    [resultPreviewViewController release];
    [super dealloc];
}

@end
